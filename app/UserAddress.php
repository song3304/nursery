<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model 
{
    use SoftDeletes;
    
    protected $fillable = ['user_id', 'account_num', 'account_name', 'account_address', 'account_phone',];
    
	public function user()
	{
		return $this->hasOne('App\\User', 'id', 'user_id');
	}
}
