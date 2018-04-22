<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    //0.小班 1.中班 2.大班 3.学前班 4.一年级 5.二年级 6.三年级 7.四年级 8.五年级 9.六年级
    const SMALL_CLASS = 0; 
    const MIDDLE_CLASS = 1; 
    const BIG_CLASS = 2; 
    const PRESCHOOL =3;
    const GRADE_ONE = 4;
    const GRADE_TWO = 5;
    const GRADE_THREE = 6;
    const GRADE_FOUR = 7;
    const GRADE_FIVE = 8;
    const GRADE_SIX = 9;
    //年级名称
    public function class_name()
    {
        $type_tag = '';
        switch ($this->class_id){
            case static::SMALL_CLASS:$type_tag='小班';break;
            case static::MIDDLE_CLASS:$type_tag='中班'; break;
            case static::BIG_CLASS:$type_tag='大班'; break;
            case static::PRESCHOOL:$type_tag='学前班';break;
            case static::GRADE_ONE:$type_tag='一年级'; break;
            case static::GRADE_TWO:$type_tag='二年级';break;
            case static::GRADE_THREE:$type_tag='三年级'; break;
            case static::GRADE_FOUR:$type_tag='四年级'; break;
            case static::GRADE_FIVE:$type_tag='五年级';break;
            case static::GRADE_SIX:$type_tag='六年级'; break;
            default: $type_tag='未知';
        }
        return $type_tag;
    }
    //年级与老师关系
    public function teachers()
    {
        return $this->belongsToMany('App\\Teacher', 'teacher_grade', 'gid', 'tid');
    }
    //现在所有老师ids
    public function teacher_ids()
    {
        return $this->teachers()->get(['teacher.id'])->pluck('id');
    }
    //年级与学生关系
    public function students()
    {
        return $this->belongsToMany('App\\User', 'student_grade', 'gid', 'sid');
    }
}
