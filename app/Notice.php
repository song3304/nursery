<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model 
{
    use SoftDeletes;
    protected $guarded = ['id'];
}
