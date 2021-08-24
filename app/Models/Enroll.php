<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    use HasFactory;

    public function course(){
        return $this->hasOne('App\Models\Course','id','course_id');
    }

    public function pay(){
        return $this->hasOne('App\Models\Paytm','enroll_id','id');
    }
    public function order(){
        return $this->hasOne('App\Models\Order','id','order_id');
    }
}
