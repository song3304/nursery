<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;

class BannerController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banner = new Banner();
        $pagesize = $request->input('pagesize') ?: config('size.models.'.$banner->getTable(),config('size.common'));
    
        //view's variant
        $this->_pagesize = $pagesize;
        $this->_filters = $this->_getFilters($request);
        $this->_queries = $this->_getQueries($request);
        return $this->view('admin.banner.list');
    }
    
    public function data(Request $request)
    {
        $banner = new Banner();
        $builder = $banner->newQuery();
    
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
        $keys = 'title,url,cover,status,location,porder';
        $this->_data = [];
        $this->_validates = $this->getScriptValidate('banner.store', $keys);
        return $this->view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = 'title,url,cover,status,location,porder';
        $data = $this->autoValidate($request, 'banner.store', $keys);
        Banner::create($data);
        return $this->success('', url('admin/banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        if (empty($banner))
            return $this->failure_noexists();

        $keys = 'title,url,cover,status,location,porder';
        $this->_validates = $this->getScriptValidate('banner.store', $keys);
        $this->_data = $banner;
        return $this->view('admin.banner.edit');
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
        $banner = Banner::find($id);
        if (empty($banner))
            return $this->failure_noexists();

        $keys = 'title,url,cover,status,location,porder';
        $data = $this->autoValidate($request, 'banner.store', $keys, $banner);
        $banner->update($data);
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
            $banner = Banner::destroy($v);
        return $this->success('');
    }
    
    public function toggle($id){
        $banner = Banner::find($id);
        if (empty($banner))
            return $this->failure_noexists();
    
        $banner->update(['status'=>$banner->status?0:1]);
        return $this->success('', url('admin/banner'));
    }
}
