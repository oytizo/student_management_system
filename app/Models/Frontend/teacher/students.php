<?php

namespace App\Models\frontend\teacher;

use App\Models\backend\teacher\teachers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class students extends Model
{
    use HasFactory;

    public   $studentvalidate = [
        'email' => 'required|email',
         's_email' => 'required|email',
         'password' => 'required',
         's_name' => 'required|string|max:255',
         'course_name' => 'required|string||max:255',
         'contact_no' =>'required',
         's_password' =>'required',
    ];

    protected $fillable = [
        'name',
        'course_name',
        'contact_no',
        't_id',
        'email',
        'password',
    ];

    public function teacher(){
        return $this->hasMany(teachers::class,'id','t_id');
    }
    public function user(){
        return $this->hasone(User::class,'email','email');
    }
}
