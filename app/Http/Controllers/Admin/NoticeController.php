<?php

namespace App\Http\Controllers\Admin;

use App\Notice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;

class NoticeController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notice = new Notice();
        $pagesize = $request->input('pagesize') ?: config('size.models.'.$notice->getTable(),config('size.common'));
    
        //view's variant
        $this->_pagesize = $pagesize;
        $this->_filters = $this->_getFilters($request);
        $this->_queries = $this->_getQueries($request);
        return $this->view('admin.notice.list');
    }
    
    public function data(Request $request)
    {
        $notice = new Notice();
        $builder = $notice->newQuery();
    
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
        $keys = 'title,contents';
        $this->_data = [];
        $this->_validates = $this->getScriptValidate('notice.store', $keys);
        return $this->view('admin.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = 'title,contents';
        $data = $this->autoValidate($request, 'notice.store', $keys);
        Notice::create($data);
        return $this->success('', url('admin/notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        if (empty($notice))
            return $this->failure_noexists();

        $keys = 'title,contents';
        $this->_validates = $this->getScriptValidate('notice.store', $keys);
        $this->_data = $notice;
        return $this->view('admin.notice.edit');
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
        $notice = Notice::find($id);
        if (empty($notice))
            return $this->failure_noexists();

        $keys = 'title,contents';
        $data = $this->autoValidate($request, 'notice.store', $keys, $notice);
        $notice->update($data);
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
            $notice = Notice::destroy($v);
        return $this->success('');
    }
}
