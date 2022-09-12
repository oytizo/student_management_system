<?php

namespace App\Models\frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_name',
        'contact_no',
        'email',
        'password',
    ];
}
