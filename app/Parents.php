<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parents extends Model 
{
    use SoftDeletes;
    protected $table = 'parents';
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->hasOne('App\\User', 'id', 'user_id');
    }
    //年级与父母关系
    public function students()
    {
        return $this->belongsToMany('App\\User', 'student_parent', 'pid', 'sid');
    }
    //学生ids
    public function student_ids()
    {
        return $this->students()->get(['user.id'])->pluck('id');
    }
}
