<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkshopEnroll extends Model
{
    use HasFactory;

    public function student(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function workshop(){
        return $this->hasOne('App\Models\Workshop','id','workshop_id');
    }
    public function payment(){
        return $this->hasOne('App\Models\Paytm','id','payment_id');
    }
}
