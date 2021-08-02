<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paytm extends Model
{
    use HasFactory;
    // protected $fillable = ['name','mobile','email','enroll_id','order_id','fee','user_id','transaction_id'];

    protected $guarded = [];

    public function enrolled_course(){
        return $this->hasOne('App\Models\Order','id','enroll_id');
    }

    public function student(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
