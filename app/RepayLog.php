<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepayLog extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
	public function order()
	{
		return $this->hasOne('App\\PayOrder', 'id', 'order_id');
	}
}
