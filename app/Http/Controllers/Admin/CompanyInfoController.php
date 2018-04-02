<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;
use App\Article;

class CompanyInfoController extends Controller
{
	use ApiTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$company_info = Article::where('type',1)->first();
		if (empty($company_info))
		    return $this->create();
		else
		    return $this->edit($company_info->getKey());
	}

	public function show($id)
	{
		return '';
	}

	public function create()
	{
		$keys = 'title,pic_id,contents,type';
		$this->_data = ['type'=>1];
		$this->_validates = $this->getScriptValidate('article.store', $keys);
		return $this->view('admin.company_info.create');
	}

	public function store(Request $request)
	{
		$keys = 'title,pic_id,contents,type';
		$data = $this->autoValidate($request, 'article.store', $keys);
		$company_info = (new Article)->create($data);
		return $this->success('', url('admin/company_info'));
	}

	public function edit($id)
	{
		$company_info = Article::find($id);
		if (empty($company_info))
			return $this->failure_noexists();

		$keys = 'title,pic_id,contents,type';
		$this->_validates = $this->getScriptValidate('article.store', $keys);
		$this->_data = $company_info;
		return $this->view('admin.company_info.edit');
	}

	public function update(Request $request, $id)
	{
		$company_info = Article::find($id);
		if (empty($company_info))
			return $this->failure_noexists();

		$keys = 'title,pic_id,contents,type';
		$data = $this->autoValidate($request, 'article.store', $keys, $company_info);
		$company_info->update($data);
		return $this->success();
	}
}
