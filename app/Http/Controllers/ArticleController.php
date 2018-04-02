<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;

class ArticleController extends Controller
{
	//公司简介
	public function companyInfo(Request $request)
	{
	    $this->_company_info = Article::where('type',1)->first();
	    $this->_site_titles = ['公司简介'];
        return $this->view('cms.company');
	}
	//公司资讯
	public function cmsInfo(Request $request)
	{
	    $id = $request->get('id');
	    $this->_company_cms = Article::find($id);
	    if (empty($this->_company_cms))
	        return $this->failure_noexists();
	    
	    $this->_site_titles = ['公司资讯'];
	    return $this->view('cms.info');
	}
}
