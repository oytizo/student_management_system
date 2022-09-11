<?php

namespace App\Models\backend\teacher;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class teacherModel1 extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'contact_no',
        'email',
        'password',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'email','t_email');
    }
}
