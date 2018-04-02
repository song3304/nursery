<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Queue;
use Illuminate\Support\Str;
use App\User;
use App\Article;
use App\Banner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
//trait
use Addons\Core\Controllers\ThrottlesLogins;


use Cache;

class HomeController extends Controller
{
    use ThrottlesLogins;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    //首页
	public function index()
	{
	    $this->_company_info = Article::where('type',1)->first();
	    $this->_company_cms = Article::where('type',2)->orderBy('created_at','desc')->take(2)->get();
	    $this->_banners = Banner::where('location',0)->where('status',1)->orderBy('porder','desc')->take(4)->get();
	    $this->_nav = 'index';//首页
        return $this->view('home.index');		
	}
}
