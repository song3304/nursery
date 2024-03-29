<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->hasOne('App\\User', 'id', 'user_id');
    }
    //年级与老师关系
    public function grades()
    {
        return $this->belongsToMany('App\\Grade', 'teacher_grade', 'tid', 'gid');
    }
    //老师现任年级
    public function current_grade()
    {
        return $this->grades()->wherePivot('is_now',1);
    } 
    //班级ids
    public function grade_ids()
    {
        return $this->grades()->get(['grades.id'])->pluck('id');
    }
    //老师与成长日记关系
    public function ceanzas()
    {
        return $this->belongsToMany('App\\Ceanza', 'ceanza_teacher', 'tid', 'cid');
    }
    //老师与相册关系
    public function albums()
    {
        return $this->belongsToMany('App\\Album', 'album_teacher', 'tid', 'aid');
    }
}
