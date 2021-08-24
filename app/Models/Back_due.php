<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Back_due extends Model
{
    use HasFactory;

    public function student(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
