<?php
namespace App\Http\Controllers\Admin;

use App\PayOrder as Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;

class OrderController extends Controller
{
	use ApiTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index(Request $request)
    {
        $order = new Order();
        $pagesize = $request->input('pagesize') ?: config('size.models.'.$order->getTable(),config('size.common'));
    
        //view's variant
        $this->_pagesize = $pagesize;
        $this->_filters = $this->_getFilters($request);
        $this->_queries = $this->_getQueries($request);
        return $this->view('admin.order.list');
    }

	public function data(Request $request)
	{
		$order = new Order();
		$builder = $order->with(['user','address'])->newQuery();
		
		$total = $this->_getCount($request, $builder, FALSE);
		$data = $this->_getData($request, $builder, function(&$datalist){
		    foreach ($datalist as &$value){
		      $value['pay_msg'] = $value->pay_msg();
		      $value['order_status'] =  $value->order_status();
		    }
		});
		$data['recordsTotal'] = $total; //不带 f q 条件的总数
		$data['recordsFiltered'] = $data['total']; //带 f q 条件的总数
		return $this->api($data);
	}

	public function export(Request $request)
	{
		$order = new Order();
		$builder = $order->newQuery()->with(['user','address']);
		$size = $request->input('size') ?: config('size.export', 1000);

		$data = $this->_getExport($request, $builder, function(&$v){
			$v['gender'] = !empty($v['gender']) ? $v['gender']['title'] : NULL;
		}, ['users.*']);
		return $this->export($data);
	}
    //订单查看
	public function show($id)
	{
		return '';
	}
    //取消
    public function cancel($id)
    {
        $order = Order::find($id);
        if($order->count()<1) return $this->failure_noexists();
        if($order->canceled())
            return $this->success('', url('admin/order'));
    }
    //充值
    public function recharge($id)
    {
        $order = Order::find($id);
        if($order->count()<1) return $this->failure_noexists();
        if($order->recharged())
            return $this->success('', url('admin/order'));
    }
    
    public function create()
    {
        $keys = 'user_id,address_id,sumMoney';//,account_num,account_name,account_address,account_phone
        $this->_validates = $this->getScriptValidate('order.store', $keys);
        $this->_data = [];
        return $this->view('admin.order.create');
    }
    
    public function store(Request $request)
    {
        $keys = 'user_id,address_id,sumMoney';
        $data = $this->autoValidate($request, 'order.store', $keys);
    
        $order = Order::create($data);
        $order->init();//初始化
        $order->pay($order->sumMoney,true,Order::PAY_OFFLINE);//线下付
        return $this->success('', url('admin/order'));
    }
    
	public function edit($id)
	{
		$order = Order::with(['user','address'])->find($id);
		if (empty($order))
			return $this->failure_noexists();
		
		$keys = 'sumMoney';
		$this->_validates = $this->getScriptValidate('order.store', $keys);
		$this->_data = $order;
		return $this->view('admin.order.edit');
	}

	public function update(Request $request, $id)
	{
		$order = Order::find($id);
		if (empty($order))
			return $this->failure_noexists();

		$keys = 'sumMoney';
		$data = $this->autoValidate($request, 'order.store', $keys, $order);
		$order->update($data);
		return $this->success();
	}

	public function destroy(Request $request, $id)
	{
		empty($id) && !empty($request->input('id')) && $id = $request->input('id');
		$id = (array) $id;
		
		foreach ($id as $v)
			$order = Order::destroy($v);
		return $this->success('', count($id) > 5, compact('id'));
	}
}

