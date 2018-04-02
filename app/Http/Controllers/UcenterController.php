<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
//trait
use Addons\Core\Controllers\ThrottlesLogins;
use App\User;
use Hash;
use App\UserAddress;
use App\PayOrder as Order;

class UcenterController extends Controller
{
    public function __construct(){
       $this->user = Auth::check() ? Auth::User() : new \App\User;
       if(empty($this->user->id)) return $this->error('member.not_login',url('member/login').'?callback_url='.urlencode(url(app('request')->path())));
       $this->_nav = 'ucenter';
    }
	//个人中心
	public function index(Request $request)
	{
        return $this->view('ucenter.index');
	}
	//个人信息
	public function info(Request $request)
	{
	    $keys = 'nickname,gender,email,avatar_aid';
	    $this->_validates = $this->getScriptValidate('member.store', $keys);
	    $this->_site_titles = ['用户信息'];
	    return $this->view('ucenter.info');
	}
	//保存个人信息
	public function saveInfo(Request $request)
	{
	     $keys = 'nickname,gender,email,avatar_aid';
	     $data = $this->autoValidate($request, 'member.store', $keys);
	     
	     $this->user->update($data);
	     return $this->success('member.modify_success');
	}
	//住址信息
	public function addressList(Request $request)
	{
	    //最多可添加5个地址
	    $this->_user_address_list = UserAddress::where('user_id',$this->user->id)->orderBy('created_at','desc')->get();
	    $this->_callback_url = $request->get('callback_url')?:url('order/index');
	    $this->_current_id = $request->get('address_id');
	    return $this->view('ucenter.address_list');
	}
	//添加住址
	public function addAddress(Request $request)
	{
	    $this->_callback_url = $request->get('callback_url');
	    $keys = 'account_num,account_name,account_address,account_phone';
	    $this->_validates = $this->getScriptValidate('user-address.store', $keys);
	    
	    return $this->view('ucenter.add_address');
	}
	//添加住址方法
	public function addedAddress(Request $request)
	{
	    $keys = 'account_num,account_name,account_address,account_phone';
	    $data = $this->autoValidate($request, 'user-address.store', $keys);
	    
	    $callback_url = $request->get('callback_url')?:url('ucenter/address_list');
	    $user_address = UserAddress::create($data+['user_id'=>$this->user->getKey()]);
	    if($user_address){
	        return $this->success('ucenter.add_address_success', url('ucenter/address_list?address_id=').$user_address->getKey().'&callback_url='.urlencode($callback_url));
	    }else{
	       return $this->failure('ucenter.add_address_fail');    
	    }
	}
	//删除住址
	public function addressRemove(Request $request)
	{
	    $address_id = intval($request->get('address_id'));
	    $result = UserAddress::destroy($address_id);
	    if($result)
	       return $this->success('ucenter.address_remove_success');
	    else
	       return $this->failure('ucenter.address_remove_fail'); 
	}
	//修改住址
	public function modifyAddress(Request $request)
	{
	    $this->_user_address = UserAddress::find($request->get("address_id"));
	    if (empty($this->_user_address)) return $this->failure_noexists();
	    
	    $this->_callback_url = $request->get('callback_url');
	    $keys = 'account_num,account_name,account_address,account_phone';
	    $this->_validates = $this->getScriptValidate('user-address.store', $keys);
	    return $this->view('ucenter.edit_address');
	}
	//修改住址方法
	public function modifiedAddress(Request $request)
	{
	    $user_address = UserAddress::find($request->get("address_id"));
	    if (empty($user_address)) return $this->failure_noexists();
	    
	    $keys = 'account_num,account_name,account_address,account_phone';
	    $data = $this->autoValidate($request, 'user-address.store', $keys);
	    
	    $callback_url = $request->get('callback_url')?:url('ucenter/address_list');
	    $result = $user_address->update($data);
	    if($result){
	        return $this->success('ucenter.edit_address_success', url('ucenter/address_list?address_id=').$user_address->getKey().'&callback_url='.urlencode($callback_url));
	    }else{
	       return $this->failure('ucenter.edit_address_fail');    
	    }
	}
	//个人缴费纪录
	public function orderList(Request $request)
	{
	    $order = new Order();
	    $pagesize = $request->input('pagesize') ?: config('size.models.'.$order->getTable(),config('size.common'));
	    $this->_order_list = $order::with(['user'])->where('user_id',$this->user->id)->orderBy('created_at','desc')->paginate($pagesize);
	    return intval($request->get('page'))>1 ?$this->view('ucenter.order_list_datatable'):$this->view('ucenter.order_list');
	}
	//删除个人缴费记录
	public function orderRemove(Request $request)
	{
	    $order_id = intval($request->get('order_id'));
	    $order = Order::where('user_id',$this->user->id)->where('id',$order_id)->first();
	    if(!empty($order) && $order->status > Order::INIT) 
	        return $this->failure('ucenter.order_cannt_remove');
	    $result = Order::where('user_id',$this->user->id)->where('id',$order_id)->delete();
	    if($result)
	        return $this->success('ucenter.order_remove_success');
	    else
	        return $this->failure('ucenter.order_remove_fail');
	}
	//个人水费查询
	public function feeInquiry(Request $request)
	{
	    return $this->view('ucenter.fee_inquiry');
	}
	//修改密码视图
	public function modifyPwd(Request $request)
	{
	    $keys = 'old_pwd,password,password_confirmation';
	    $this->_validates = $this->getScriptValidate('member.modify_pwd', $keys);
	    $this->_site_titles = ['用户密码修改'];
	    
	    return $this->view('ucenter.modify_pwd');
	}
	//修改密码
	public function modifiedPwd(Request $request)
	{
	    $keys = 'old_pwd,password,password_confirmation';
	    $data = $this->autoValidate($request, 'member.modify_pwd', $keys);
	   
	    if(Hash::check($data['old_pwd'], $this->user->getAuthPassword())){
	        $update_data = ['password'=>bcrypt($data['password'])];
	        $this->user->update($update_data);
	        return $this->success('ucenter.modify_pwd_success',url('ucenter'));
	    }else{
	        return $this->failure('ucenter.old_pwd_error');
	    }
	}
}
