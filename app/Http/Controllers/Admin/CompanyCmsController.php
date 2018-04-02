<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;
use App\Article;

class CompanyCmsController extends Controller
{
	use ApiTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
   public function index(Request $request)
    {
        $company_cms = new Article();
        $pagesize = $request->input('pagesize') ?: config('size.models.'.$company_cms->getTable(),config('size.common'));
    
        //view's variant
        $this->_pagesize = $pagesize;
        $this->_filters = $this->_getFilters($request);
        $this->_queries = $this->_getQueries($request);
        return $this->view('admin.company_cms.list');
    }
    
    public function data(Request $request)
    {
        $company_cms = new Article();
        $builder = $company_cms->newQuery()->where('type',2);
    
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
        $keys = 'title,pic_id,contents,type';
		$this->_data = ['type'=>2];
        $this->_validates = $this->getScriptValidate('article.store', $keys);
        return $this->view('admin.company_cms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = 'title,pic_id,contents,type';
        $data = $this->autoValidate($request, 'article.store', $keys);
        Article::create($data);
        return $this->success('', url('admin/company_cms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company_cms = Article::find($id);
        if (empty($company_cms))
            return $this->failure_noexists();

        $keys = 'title,pic_id,contents,type';
        $this->_validates = $this->getScriptValidate('article.store', $keys);
        $this->_data = $company_cms;
        return $this->view('admin.company_cms.edit');
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
        $company_cms = Article::find($id);
        if (empty($company_cms))
            return $this->failure_noexists();

        $keys = 'title,pic_id,contents,type';
        $data = $this->autoValidate($request, 'article.store', $keys, $company_cms);
        $company_cms->update($data);
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
            $company_cms = Article::destroy($v);
        return $this->success('');
    }
}
