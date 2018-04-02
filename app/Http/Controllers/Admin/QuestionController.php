<?php
namespace App\Http\Controllers\Admin;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;
use Illuminate\Support\Facades\Auth;
use App\User;

class QuestionController extends Controller
{
	use ApiTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $question = new Question();
        $pagesize = $request->input('pagesize') ?: config('size.models.'.$question->getTable(),config('size.common'));
    
        //view's variant
        $this->_pagesize = $pagesize;
        $this->_filters = $this->_getFilters($request);
        $this->_queries = $this->_getQueries($request);
        return $this->view('admin.question.list');
    }
    
    public function data(Request $request)
    {
        $question = new Question();
        $builder = $question->with(['user','parents'])->newQuery();
    
        $total = $this->_getCount($request, $builder, FALSE);
        $data = $this->_getData($request, $builder, null);
        $data['recordsTotal'] = $total; //不带 f q 条件的总数
        $data['recordsFiltered'] = $data['total']; //带 f q 条件的总数
        return $this->api($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keys = 'user_id,content,pid';
        $this->_data = [];
        $this->_validates = $this->getScriptValidate('question.store', $keys);
        $user = Auth::check() ? Auth::User() : new \App\User;
        $this->_act = 'create';
        $this->_data = ['user_id'=>$user->getKey(),'pid'=>0];
        return $this->view('admin.question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = 'user_id,content,pid';
        $data = $this->autoValidate($request, 'question.store', $keys);
        $pid = $data['pid'];unset($data['pid']);
        $question = Question::create($data);
        if(!empty($pid)) $question->moveInner($pid);
        return $this->success('', url('admin/question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::with(['user','parents'])->find($id);
        if (empty($question))
            return $this->failure_noexists();

        $keys = 'user_id,content,pid';
        $this->_validates = $this->getScriptValidate('question.store', $keys);
        $this->_data = $question;
        $this->_act = 'edit';
        return $this->view('admin.question.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        if (empty($question))
            return $this->failure_noexists();

        $keys = 'user_id,content,pid';
        $data = $this->autoValidate($request, 'question.store', $keys, $question);
        $question->update($data);
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        empty($id) && !empty($request->input('id')) && $id = $request->input('id');
        $id = (array) $id;

        foreach ($id as $v)
            $question = Question::destroy($v);
        return $this->success('');
    }
    
    public function reply(Request $request,$id)
    {
        $question = Question::with(['user','parents'])->find($id);
        if (empty($question))
            return $this->failure_noexists();

        $keys = 'user_id,content,pid';
        $this->_validates = $this->getScriptValidate('question.store', $keys);
        $this->_act = 'reply';
        $user = Auth::check() ? Auth::User() : new \App\User;
        $this->_data = ['pid'=>$question->getKey(),'user_id'=>$user->getKey(),'user'=>$question->user,'parents'=>$question];
        return $this->view('admin.question.create');
    }
}
