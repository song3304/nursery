<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ceanza extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->hasOne('App\\User', 'id', 'user_id');
    }
    
    public function grade()
    {
        return $this->hasOne('App\\Grade', 'id', 'grade_id');
    }
    
    //成长日记 与学生关系
    public function students()
    {
        return $this->belongsToMany('App\\User', 'ceanza_student', 'cid', 'sid');
    }
    //成长日记与老师的关系
    public function teachers()
    {
        return $this->belongsToMany('App\\Teacher', 'ceanza_teacher', 'cid', 'tid');
    }
    
    public function class_name()
    {
        $type_tag = '';
        switch ($this->class_id){
            case Grade::SMALL_CLASS:$type_tag='小班';break;
            case Grade::MIDDLE_CLASS:$type_tag='中班'; break;
            case Grade::BIG_CLASS:$type_tag='大班'; break;
            case Grade::PRESCHOOL:$type_tag='学前班';break;
            case Grade::GRADE_ONE:$type_tag='一年级'; break;
            case Grade::GRADE_TWO:$type_tag='二年级';break;
            case Grade::GRADE_THREE:$type_tag='三年级'; break;
            case Grade::GRADE_FOUR:$type_tag='四年级'; break;
            case Grade::GRADE_FIVE:$type_tag='五年级';break;
            case Grade::GRADE_SIX:$type_tag='六年级'; break;
            default: $type_tag='未知';
        }
        return $type_tag;
    }
}
