<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notice;
use App\Banner;

class NoticeController extends Controller
{
	//公告简介
	public function index(Request $request)
	{
	    $this->_notices = Notice::orderBy('created_at','desc')->get();
	    //获取banner
	    $this->_banner = Banner::where('location',2)->where('status',1)->orderBy('porder','desc')->first();
        return $this->view('notice.list');
	}
	//公告详情
	public function info(Request $request)
	{
	    $id = $request->get('id');
	    $this->_notice = Notice::find($id);
	    if (empty($this->_notice))
	        return $this->failure_noexists();
	    //获取banner
	    $this->_banner = Banner::where('location',2)->where('status',1)->orderBy('porder','desc')->first();
	    return $this->view('notice.info');
	}
}
