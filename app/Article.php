<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    const KINDERGARTEN = 0; //幼儿园介绍
    const NEWS = 1; //新闻掠影
    const RECRUINT = 2; //招生招聘
    const CONTACT_US = 3; //联系我们
    
    public function type()
    {
        $type_tag = '';
        switch ($this->type){
            case static::KINDERGARTEN:$type_tag='幼儿园介绍';break;
            case static::NEWS:$type_tag='新闻掠影'; break;
            case static::RECRUINT:$type_tag='招生招聘'; break;
            case static::CONTACT_US:$type_tag='联系我们'; break;
            default: $type_tag='未知';
        }
        return $type_tag;
    }
    //发表用户
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
