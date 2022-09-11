<?php

namespace App\Models\Backend\Teacher;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teacherModel extends Model
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
        return $this->belongsTo(User::class,'email', 'email');
    }
}
