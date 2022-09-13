<?php

namespace App\Models\frontend\teacher;

use App\Models\backend\teacher\teachertable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class studenttable extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_name',
        'contact_no',
        't_id',
        'email',
        'password',
    ];

    public function teacher(){
        return $this->hasMany(teachertable::class,'id','id');
    }
    public function user(){
        return $this->hasone(User::class,'email','email');
    }
}
