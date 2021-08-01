<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function InCart(){
        return $this->hasMany('App\Models\Enroll','order_id','id');
    }
    public function paytm_payments(){
        return $this->hasMany('App\Models\Paytm','enroll_id','id');
    }
}
