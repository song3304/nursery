<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Cache;
use App\RepayLog;
use App\UserAddress;

class PayOrder extends Model 
{
    use SoftDeletes;
    public $auto_cache = true;
    protected $guarded = ['id'];
    
    const UNKNOWN = 0; //未知
    const INIT = 1; //商品确认
    const CANCELED = -1; //订单已取消
    const PAID = 2; //订单已支付
    const REFUSED = -3; //订单退款
    const RECHARGED = 3; //充值成功
    const COMPARE_BILL_FAIL = -20; //对账失败
    
    const PAY_NONE = 0;
    const PAY_OFFLINE = 1;
    const PAY_ALIPAY = 2;
    const PAY_WEIXIN = 3;
    const PAY_RCB = 4;          //农商银行
    
	public function user()
	{
		return $this->hasOne('App\\User', 'id', 'user_id');
	}
	
	public function address()
	{
	    return $this->hasOne('App\\UserAddress', 'id', 'address_id');
	}
	
	public function order_status()
	{
	    $status_tag = '';
	    switch ($this->status){
	        case static::INIT:$status_tag='未支付';break;
	        case static::CANCELED:$status_tag='已取消'; break;
	        case static::PAID:$status_tag='已支付'; break;
	        case static::RECHARGED:$status_tag='已充值'; break;
	        case static::REFUSED:$status_tag='充值失败'; break;
	        case static::COMPARE_BILL_FAIL:$status_tag='对账失败';break;
	        default: $status_tag='未知';
	    }
	    return $status_tag;
	}
	
	public function pay_msg()
	{
	    $pay_msg = '';
	    switch ($this->pay_type){
	        case static::PAY_NONE:$pay_msg='未支付';break;
	        case static::PAY_OFFLINE:$pay_msg='线下支付'; break;
	        case static::PAY_ALIPAY:$pay_msg='支付宝(订单号:'.$this->out_trade_no.')'; break;
	        case static::PAY_WEIXIN:$pay_msg='微信支付(订单号:'.$this->out_trade_no.')'; break;
	        case static::PAY_RCB:$pay_msg='农商银行'; break;
	        default: $pay_msg='未知';
	    }
	    return $pay_msg;
	}
	
	public function init($transaction = TRUE)
	{
	    $transaction && DB::beginTransaction();
	    $order = static::where($this->getKeyName(), $this->getKey())->lockForUpdate()->first();
	
	    if ($order->status != static::UNKNOWN) //刚刚加入到数据库
	    {
	        $transaction && DB::rollback();
	        return false;
	    }
	
	    $order->status = static::INIT;
	    $order->save();

	    $transaction && DB::commit();
	    return true;
	}
	
	public function canceled($transaction = TRUE)
	{
	    $transaction && DB::beginTransaction();
	    $order = static::where($this->getKeyName(), $this->getKey())->lockForUpdate()->first();
	
	    if ($order->status != static::INIT) //初始状态或者是退款状态
	    {
	        $transaction && DB::rollback();
	        return false;
	    }
	
	    $order->status = static::CANCELED;

	    $order->save();
	    $transaction && DB::commit();
	    return true;
	}
	
	//支付
	public function pay($total_fee, $transaction = TRUE, $paytype = Order::PAY_WEIXIN, $out_trade_no='')
	{
	    $this->check_repeat_pay($total_fee,$paytype,$out_trade_no);
	    $transaction && DB::beginTransaction();
	    $order = static::where($this->getKeyName(), $this->getKey())->lockForUpdate()->first();
	
	    if ($order->status != static::INIT) //初始状态
	    {
	        $transaction && DB::rollback();
	        return false;
	    }
	
	    //对账失败
	    $checkMoney = $paytype == static::PAY_WEIXIN ? $order->sumMoney * 100:$order->sumMoney;
	    if (abs($total_fee - $checkMoney) >= 0.01 )
	    {
	        $order->status = static::COMPARE_BILL_FAIL;
	        $order->save();
	        $transaction && DB::commit();
	        return false;
	    }
	
	    $order->pay_type = $paytype;
	    $order->out_trade_no = $out_trade_no;
	    $order->status = static::PAID;
	    $order->save();
	
	    $transaction && DB::commit();
	    return true;
	}
	//充值成功
	public function recharged($transaction = TRUE)
	{
	    $transaction && DB::beginTransaction();
	    $order = static::where($this->getKeyName(), $this->getKey())->lockForUpdate()->first();
	
	    if ($order->status != static::PAID) //刚刚加入到数据库
	    {
	        $transaction && DB::rollback();
	        return false;
	    }
	
	    $order->status = static::RECHARGED;
	    $order->save();
	
	    $transaction && DB::commit();
	    return true;
	}
	
	//充值失败，退款
	public function refused($transaction = TRUE)
	{
	    $transaction && DB::beginTransaction();
	    $order = static::where($this->getKeyName(), $this->getKey())->lockForUpdate()->first();
	
	    if ($order->status != static::PAID) //刚刚加入到数据库
	    {
	        $transaction && DB::rollback();
	        return false;
	    }
	    //处理具体退款操作
	    
	    
	    $order->status = static::REFUSED;
	    $order->save();
	
	    $transaction && DB::commit();
	    return true;
	}
	//检查再次支付
	public function check_repeat_pay($total_fee,$paytype,$out_trade_no){
	    if($this->status == static::PAID && $this->pay_type >0 && $this->out_trade_no != $out_trade_no){//已经支付
	        //避免重复发送
	        $repeat_key = "repeat_" . $out_trade_no;
	        if (Cache::has($repeat_key)) return false;
	         
	        Cache::put($repeat_key, 1, 5);//分钟数缓存5分钟
	        $pay_msg = '水费 订单号:'.$this->getKey().' 已重复支付,支付信息为:';
	        switch ($paytype){
	            case static::PAY_NONE:$pay_msg.='未支付';break;
	            case static::PAY_OFFLINE:$pay_msg.='线下支付'; break;
	            case static::PAY_ALIPAY:$pay_msg.='支付宝(订单号:'.$out_trade_no.')'; break;
	            case static::PAY_WEIXIN:$pay_msg.='微信支付(订单号:'.$out_trade_no.')'; break;
	            case static::PAY_RCB:$pay_msg.='农商银行支付'; break;
	            default: $pay_msg.='未知';
	        }
	        //保存重复支付信息
	        RepayLog::create(['order_id'=>$this->getKey(),'order_log'=>$pay_msg]);
	        //$clapi  = new ChuanglanSmsApi();
	        //$clapi->sendSMS('18910545057',$pay_msg,'false');//董斌手机号
	    }
	    return false;
	}
}

//自动创建UserPieceDetail
PayOrder::creating(function($order){
    $address = UserAddress::find($order->address_id);
    $order->account_num = $address->account_num;
    $order->account_name = $address->account_name; 
    $order->account_address = $address->account_address;
    $order->account_phone = $address->account_phone;
});
