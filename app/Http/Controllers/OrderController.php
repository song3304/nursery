<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PayOrder as Order;
use Auth;
use Cache;
use App\User;
use App\UserAddress;
//微信二维码支付
use Plugins\Wechat\App\Tools\API;
use Plugins\Wechat\App\WechatAccount;
use Plugins\Wechat\App\Tools\Pay\BizPayUrl;
use Plugins\Wechat\App\Tools\Pay as WechatPayTool;
use Plugins\Wechat\App\Tools\Pay\UnifiedOrder;
use Plugins\Wechat\App\Tools\Feedback;
//支付宝
use App\Tools\Alipay\AlipayTradeWapPayContentBuilder;
use App\Tools\Alipay\AlipayTradeService;

class OrderController extends Controller
{
    public function __construct(){
        $this->user = Auth::check() ? Auth::User() : new \App\User;
        if(empty($this->user->id)) return $this->error('member.not_login',url('member/login').'?callback_url='.urlencode(url(app('request')->path())));
        $this->_nav = 'pay_water';
    }
	//交水费主界面
	public function index(Request $request)
	{
	    $keys = 'address_id,sumMoney';
	    $this->_validates = $this->getScriptValidate('order.store', $keys);
	    
	    $aid = $request->get('aid');
	    $this->_user_address = ($aid)?UserAddress::find($aid):UserAddress::where('user_id',$this->user->id)->orderBy('created_at','desc')->first();
	    $this->_site_titles = ['交水费'];
        return $this->view('order.index');
	}
	//生成订单,去支付
	public function toPay(Request $request)
	{
	    //生成订单，选择支付方式
	    $keys = 'address_id,sumMoney';
	    $data = $this->autoValidate($request, 'order.store', $keys);
	    
	    $order = Order::create($data+['user_id'=>$this->user->getKey()]);
	    if($order){
	        $order->init();
	        return $this->success('order.create_order_success', url('order/choose_pay?id=').$order->getKey());
	    }else{
	       return $this->failure('order.create_order_fail');    
	    }
	}
	//选择支付方式
	public function choosePay(Request $request)
	{
	    $order = Order::find($request->get("id"));
	    if (empty($order)) return $this->failure_noexists();
	    	    
	    $this->_order = $order;
	    return $this->view('order.choose_pay');
	}
	
	//去支付
	public function pay(Request $request)
	{
	   $order = Order::find($request->get("id"));
	   if (empty($order)) return $this->failure_noexists();

	   $pay_type = $request->get('pay_type');
	   //是否需要重新生成订单
	   if($order->status >= Order::PAID){
	       //重新生成订单
	       $order_data = ['user_id'=>$order->user_id,'pay_type'=>$pay_type,'address_id'=>$order->address_id,'sumMoney'=>$order->sumMoney,'status'=>Order::INIT];
	       $order = Order::create($order_data);
	   }else{
	       $order->update(['pay_type'=>$pay_type,'status'=>Order::INIT]);
	   }

	   $this->_order = $order;
	   //跳转到相应支付
	   if($pay_type == Order::PAY_WEIXIN){
	       //微信支付
	       $account = WechatAccount::findOrFail(1);//
	       $api = new API($account->toArray(), $account->getKey());
	       $pay = new WechatPayTool($api);
	       $bizpayurl = new BizPayUrl();
	       $bizpayurl->setProductId($order->getKey());
	       $qrcode = $pay->bizpayurl($bizpayurl);unset($qrcode['sub_mch_id']);
           $this->_qrcode = 'weixin://wxpay/bizpayurl?'.http_build_query($qrcode);
           $this->_pay_info = ['type'=>"weixin",'msg'=>'请使用微信客户端，打开扫一扫,完成支付.'];
	   }elseif($pay_type == Order::PAY_ALIPAY){
	       $out_trade_no = date('ymdHis').str_pad($order->getKey(), 8, '0', STR_PAD_LEFT);
	       //订单名称，必填
	       $subject = '交水费';
	       //付款金额，必填
	       $total_amount = $order->sumMoney;
	       //商品描述，可空
	       $body = '(地址:'.$order->account_address.')';
	       //超时时间 1分钟
	       $timeout_express="1m";
	       //支付宝
	       $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
	       $payRequestBuilder->setBody($body);
	       $payRequestBuilder->setSubject($subject);
	       $payRequestBuilder->setOutTradeNo($out_trade_no);
	       $payRequestBuilder->setTotalAmount($total_amount);
	       $payRequestBuilder->setTimeExpress($timeout_express);
	       
	       $payResponse = new AlipayTradeService(config('services.alipay_sand_box_config'));
	       $result=$payResponse->wapPay($payRequestBuilder,url('order/paysuccess?order_id=').$order->getKey(),url('pay/notifyAlipay/'.$order->getKey()));

	       return redirect($result);
	       //$this->_qrcode = $result;
           //$this->_pay_info = ['type'=>"alipay",'msg'=>'请使用支付宝客户端，打开扫一扫,完成支付.'];
	   }elseif($pay_type == Order::PAY_RCB){
	       //农商行 未处理
	       
	   }

	   return $this->view('order.go_to_pay');
	}
	//支付成功，跳出页面
	public function paysuccess(Request $request)
	{
	    $order = Order::find($request->get("order_id"));
	    if (empty($order)) return $this->failure_noexists();
	    if($order->status<Order::PAID){
	        return $this->failure('order.scan_code_fail');  
	    }else{
	        $this->_order = $order;
	    }
	    return $this->view('order.paysuccess');
	}
	//监听订单
	public function listenOrder(Request $request)
	{
	   $order_id = $request->get("order_id");
	   $order = Order::find($order_id);
	   if(isset($order->status)&&$order->status>=Order::PAID){
	       return $this->success('order.pay_success');
	   }else{
	       return $this->failure('order.pay_unknow');
	   }
	}
}
