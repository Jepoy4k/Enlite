<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'StudentID';

    protected $fillable = [
        'UserID', 'FirstName', 'MiddleName', 'LastName', 'Email', 'Address', 'Birthdate', 'ContactNumber', 'EnrollmentStatus'
    ];

    public function user()
    {
        return $this->belongsTo(AllUser::class, 'UserID');
    }
}
