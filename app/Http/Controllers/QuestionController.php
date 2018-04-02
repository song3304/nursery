<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Question;
use App\Banner;
use App\Article;

class QuestionController extends Controller
{
    public function __construct(){
        $this->user = Auth::check() ? Auth::User() : new \App\User;
        $this->_nav = 'faq';
    }
	//咨询帮助
	public function index(Request $request)
	{
	    //常见问题banner
	    $this->_banner = Banner::where('location',4)->where('status',1)->orderBy('porder','desc')->first();
        return $this->view('question.index');
	}
	//常见问题列表
	public function common(Request $request)
	{
	    //常见问题banner
	    $this->_banner = Banner::where('location',4)->where('status',1)->orderBy('porder','desc')->first();
	    
	    $article = new Article();
	    $pagesize = $request->input('pagesize') ?: config('size.models.'.$article->getTable(),config('size.common'));
	    $this->_question_list = $article::where('type',0)->orderBy('created_at','desc')->paginate($pagesize);
	    return intval($request->get('page'))>1 ?$this->view('question.common_datatable'):$this->view('question.common');
	}
	//常见详情
	public function detail(Request $request)
	{
	    $article_id = $request->get('id');
	    $this->_article = Article::find($article_id);
	    if (empty($this->_article))
	        return $this->failure_noexists();
	    //常见问题banner
	    $this->_banner = Banner::where('location',4)->where('status',1)->orderBy('porder','desc')->first();
	    return $this->view('question.detail');
	}
	//咨询解答
	public function faqList(Request $request)
	{     
	    $question = new Question();
	    $pagesize = $request->input('pagesize') ?: config('size.models.'.$question->getTable(),config('size.common'));
	    $this->_question_list = $question::with(['childrens'])->where('pid',0)->orderBy('created_at','desc')->paginate($pagesize);
	    //我的问题banner
	    $this->_banner = Banner::where('location',5)->where('status',1)->orderBy('porder','desc')->first();
	    return intval($request->get('page'))>1 ?$this->view('question.my_faq_datatable'):$this->view('question.my_faq');
	}
	//咨询解答
	public function faqItem(Request $request)
	{
	    $faq_id = $request->get('id');
	    $this->_question = Question::with(['childrens'])->find($faq_id);
	    if (empty($this->_question))
	        return $this->failure_noexists();
	    //dd($this->_question);
	    //常见问题banner
	    $this->_banner = Banner::where('location',5)->where('status',1)->orderBy('porder','desc')->first();
	    return $this->view('question.faq_item');
	}
	//我的问题
	public function myFaq(Request $request)
	{
	    if(empty($this->user->id)){
	        return $this->error('member.not_login',url('member/login').'?callback_url='.urlencode(url(app('request')->path())));
	    }
	    
	    $question = new Question();
	    $pagesize = $request->input('pagesize') ?: config('size.models.'.$question->getTable(),config('size.common'));
	    $this->_question_list = $question::with(['childrens'])->where('user_id',$this->user->id)->where('pid',0)->orderBy('created_at','desc')->paginate($pagesize);
	    //我的问题banner
	    $this->_banner = Banner::where('location',5)->where('status',1)->orderBy('porder','desc')->first();
	    return intval($request->get('page'))>1 ?$this->view('question.my_faq_datatable'):$this->view('question.my_faq');
	}
	//我要提问
	public function askFaq(Request $request)
	{
	    $keys = 'content';
	    $this->_validates = $this->getScriptValidate('question.store', $keys);
	    $this->_site_titles = ['我要提问'];
	    return $this->view('question.ask_faq');
	}
	//保存提问
	public function saveFaq(Request $request)
	{
	    $keys = 'content';
	    $data = $this->autoValidate($request, 'question.store', $keys);
	     
	    $question = Question::create($data+['user_id'=>$this->user->id]);
	    return $this->success('ucenter.faq_save_success', url('question/my_faq'));
	}
}
