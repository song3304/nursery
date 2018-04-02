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
use App\Role;

class MemberController extends Controller
{
    use ThrottlesLogins;
	//注册界面
	public function register(Request $request)
	{
	    
	    $this->_callback_url = $request->get('callback_url');
	    $keys = 'username,password,password_confirmation,avatar_aid';
	    $this->_validates = $this->getScriptValidate('member.store', $keys);
	    $this->_site_titles = ['用户注册'];
	    return $this->view('member.register');
	}
	//用户注册
	public function addMember(Request $request)
	{
	     $keys = 'username,password,password_confirmation,avatar_aid';
	     $data = $this->autoValidate($request, 'member.store', $keys);
	     unset($data['password_confirmation']);
	
	     $find_user = User::where('username',$data['username'])->first();
	     if(empty($find_user)){
	         unset($data['password_confirmation']);
	         $user = (new User)->add($data);
	         $user->roles()->sync([1]);
	         $this->guard()->attempt(['username' => $data['username'], 'password' => $data['password']]);
	         $url = $request->get('callback_url')?:url('home/index');
	         return $this->success('member.register_success', $url);
	    }else{
	    	 return $this->failure('member.register_fail');
	  }
	}
	//用户登录界面
	public function login(Request $request)
	{
	    $this->_site_titles = ['用户登录'];
	    $this->_callback_url = $request->get('callback_url');
	    $keys = 'username,password';
	    $this->_validates = $this->getScriptValidate('member.login', $keys);
	    return $this->view('member.login');
	}
	//用户登录
	public function auth(Request $request)
	{
	    $this->guard()->logout();
	    $keys = ['username','password'];
	    $data = $this->autoValidate($request, 'member.login', $keys);
	    if($this->guard()->attempt(['username' => $data['username'], 'password' => $data['password']])){
	       $url = $request->get('callback_url')?:url('ucenter');
	       $user = $this->guard()->user();
	       return $this->success_login($url);
	    }else{
	       return $this->failure_login(url('member/login'));
	    }
	}
	//退出
	public function logout(Request $request)
	{
	    $this->guard()->logout();
	    $request->session()->flush();
	    $request->session()->regenerate();
	    return $this->success_logout(''); // redirect to homepage
	}
	protected function guard()
	{
	    return Auth::guard();
	}
}
