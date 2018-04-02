<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Addons\Core\Controllers\ApiTrait;
use App\PayOrder as Order;
use DB;

class StatisticsController extends Controller
{
	use ApiTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$order = new Order;
		$builder = $order->newQuery()->where('status','>=',Order::PAID)->groupBy(DB::raw('date(created_at)'));
		$pagesize = $request->input('pagesize') ?: config('size.models.'.$order->getTable(),config('size.common'));
		$base = boolval($request->input('base')) ?: false;
        
		$this->_base = $base;	
		$this->_pagesize = $pagesize;
		$this->_filters = $this->_getFilters($request);
		$this->_queries = $this->_getQueries($request);
		return $this->view('admin.statistics.list');
	}

	public function data(Request $request)
	{
		$order = new Order;
		$builder = $order->newQuery()->where('status','>=',Order::PAID)->groupBy(DB::raw('date(created_at)'));
		$total = $this->_getCount($request, $builder, FALSE);
		
		$static_data = $this->static_all($order->newQuery()->where('status','>=',Order::PAID)->groupBy(DB::raw('date(created_at) desc,pay_type'))->get(['*', DB::raw('date(created_at) as s_date,sum(`sumMoney`) as `s_val`')]));
		$data = $this->_getData($request, $builder);
		$data['recordsTotal'] = $total;
		$data['recordsFiltered'] = $data['total'];
		$data['data'] = $static_data;
		return $this->api($data);		
	}
	
	public function export(Request $request)
	{
		$order = new Order;
		$builder = $order->newQuery()->where('status','>=',Order::PAID)->groupBy(DB::raw('date(created_at)'));
		$page = $request->input('page') ?: 0;
		$pagesize = $request->input('size') ?: config('size.export', 1000);
		$_builder = clone $builder;
		$total = $_builder->count();

		if (empty($page)){
			$this->_of = $request->input('of');
			$this->_table = $order->getTable();
			$this->_total = $total;
			$this->_pagesize = $pagesize > $total ? $total : $pagesize;
			return $this->view('admin.statistics.export');
		}

		if(!empty($request->get('f'))){
		    $filters = $request->get(f);
		    if(!empty($filters['created_at'])){$created_at=$filters['created_at'];$data[] = ['起始时间',$created_at['min'],'终止时间',$created_at['max']];}
		}
	    $data[]= ['编号','日期','购买','线下','支付宝','微信 '];
		$static_data = $this->static_all($order->newQuery()->where('status','>=',Order::PAID)->groupBy(DB::raw('date(created_at) desc,pay_type'))->get(['*', DB::raw('date(created_at) as s_date,sum(`sumMoney`) as `s_val`')]));
		foreach ($static_data as $item){
		    $data[] = [
		        '编号'=>$item['id'],
		        '日期'=>$item['s_date'],
		        '购买'=>$item['purchase'],
		        '线上'=>$item['offline'],
		        '支付宝'=>$item['alipay'],
		        '微信'=>$item['weixin'],
		    ];
		}
		return $this->success('', FALSE, $data);
	}
	//统计数据整理
	private function static_all($data)
	{
	    $return_data = array();$i=1;
	    foreach ($data as $item)
	    {
	       $date = date("Y-m-d",strtotime($item['created_at']));
	       if(!isset($return_data[$date]))
	           $return_data[$date] = ['id'=>$i++,'s_date'=>$date,'purchase'=>0,'offline'=>0,'alipay'=>0,'weixin'=>0];
	       switch ($item['pay_type']){
	           case Order::PAY_OFFLINE:
	               $return_data[$date]['offline']+=$item['s_val'];
	               break;
	           case Order::PAY_ALIPAY:
	               $return_data[$date]['alipay']+=$item['s_val'];
	               break;
	           case Order::PAY_ALIPAY:
	               $return_data[$date]['weixin']+=$item['s_val'];
	               break;
	           case Order::PAY_RCB:
	               $return_data[$date]['rcb']+=$item['s_val'];
	               break;
	       }
	       $return_data[$date]['purchase']+=$item['s_val'];
	    }
	    return array_values($return_data);
	}
}

