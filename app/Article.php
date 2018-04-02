<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    const QUESTION = 0; //常见问题
    const INFO = 1; //公司简介
    const CMS = 2; //公司资讯
    
    public function type()
    {
        $type_tag = '';
        switch ($this->type){
            case static::QUESTION:$type_tag='常见问题';break;
            case static::INFO:$type_tag='公司简介'; break;
            case static::CMS:$type_tag='公司资讯'; break;
            default: $type_tag='未知';
        }
        return $type_tag;
    }
}
