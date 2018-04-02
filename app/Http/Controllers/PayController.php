<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cache;

use App\AlipayBill;
use Plugins\Wechat\App\WechatAccount;
use Plugins\Wechat\App\Tools\API;
use Plugins\Wechat\App\Tools\Pay as WechatPayTool;
use Plugins\Wechat\App\WechatBill;
use App\PayOrder as Order;
use Plugins\Wechat\App\Tools\Pay\UnifiedOrder;
use Plugins\Wechat\App\Tools\Feedback;

use App\Tools\Alipay\AlipayTradeService;

class PayController extends Controller
{
    //支付宝支付
	public function notifyAlipay(Request $request,$oid=null){
	    $oid = $request->input('oid') ?: $oid;
        
	    $alipaySevice = new AlipayTradeService(config('services.alipay_sand_box_config'));
	    $result = $alipaySevice->check($request->all());
	    if($result) {//验证成功
	        //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	        //商户订单号
	        $out_trade_no = $request->input('out_trade_no');
	        //支付宝交易号
	        $trade_no = $request->input('trade_no');
	        //交易状态
	        $trade_status = $request->input('trade_status');
	        $alipay_log = array_only($request->all(), ['notify_time','notify_type','notify_id','out_trade_no','subject','out_biz_no','trade_no','trade_status','seller_id','seller_email','buyer_id','buyer_logon_id','total_amount','receipt_amount','buyer_pay_amount','body','gmt_create','gmt_payment','point_amount','fund_bill_list','voucher_detail_list']);
	        //记录日志
	        AlipayBill::create($alipay_log+['order_id'=>$oid]);
	        if($trade_status == 'TRADE_FINISHED') {
	            $order = Order::findOrFail(intval($oid));
	            $order->pay($request->input('total_amount'),true,Order::PAY_ALIPAY,$request->input('out_trade_no'));
	        }
	        else if ($trade_status == 'TRADE_SUCCESS') {
	            $order = Order::findOrFail(intval($oid));
	            $order->pay($request->input('total_amount'),true,Order::PAY_ALIPAY,$request->input('out_trade_no'));
	        }
	        
	        echo "success";		//请不要修改或删除
	    }else{
            //验证失败
            echo "fail";	//请不要修改或删除
        }
	}
    //微信支付
    public function notifyWeixin(Request $request,$oid=null){
        $oid = $request->input('oid') ?: $oid;
        $account = WechatAccount::findOrFail(1);
        $api = new API($account->toArray(), $account->getKey());
         
        $pay = new WechatPayTool($api);
        $result = $pay->notify(function($result, &$message) use ($account, $oid){
            if ($result['return_code'] == 'SUCCESS')
            {
                $result = array_only($result, ['return_code','return_msg','mch_id','device_info','result_code','err_code','err_code_des','trade_type','bank_type','total_fee','fee_type','cash_fee','cash_fee_type','coupon_fee','coupon_count','transaction_id','out_trade_no','attach','time_end']);
                //$wechatUser = $api->getUserInfo($result['openid']);//获取微信用户信息
                WechatBill::create($result + ['waid' => $account->getKey(), 'wuid' => 0]);
                //因为是微信访问的，只能靠记录日志来查询是否失败
                $order = Order::findOrFail(intval($oid));
                $order->pay($result['total_fee'],true,Order::PAY_WEIXIN,$result['out_trade_no']);
                //$this->dispatch( (new \App\Jobs\OrderDeal($order))->delay(config('site.order.deal', 14 * 86400)) );
            } else
                WechatBill::create(['return_code' => $result['return_code'], 'return_msg' => $result['return_msg'], 'waid' => $account->getKey()]);
            return true;
        });
        return $result;
    }
    //农商银行支付
    public function notifyRBC(Request $request,$oid=null){
        //未处理
    }
    /**
     * 微信支付回调
     * @return [type] [description]
     */
    public function feedback(Request $request)
    {
        $account = WechatAccount::findOrFail(1);
        $api = new API($account->toArray(), $account->getKey());
    
        $pay = new WechatPayTool($api);
        $result = $pay->notify(function($result, &$message) use($pay,$api){
            $order_id = $result['product_id'];
            $order = Order::find($order_id);
            if (empty($order)){
                return $this->failure_noexists();
            }
    
            $title = '交水费(地址:'.$order->account_address.')';
            $unified_order = (new UnifiedOrder('NATIVE', date('ymdHis').str_pad($order->getKey(), 8, '0', STR_PAD_LEFT), $title, $order->sumMoney*100))
            ->SetNotify_url(url('pay/notifyWeixin/'.$order->getKey()))
            ->setProductId($order_id);
            $UnifiedOrderResult = $pay->unifiedOrder($unified_order);
            if ( $UnifiedOrderResult['return_code'] != 'SUCCESS' || empty($UnifiedOrderResult['prepay_id']))
                return $this->failure(['content' => $UnifiedOrderResult['return_msg']]);
    
            $feedback = new Feedback($api);
            $xml =  $feedback->getPayXML($UnifiedOrderResult);

            echo $xml;exit;
        });
        return $result;
    }
}
