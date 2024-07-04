<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $primaryKey = 'EnrollmentID';

    protected $fillable = [
        'Year_SemID',
        'StudentID',
        'Course_InstructorID'
    ];

    public function yearSem()
    {
        return $this->belongsTo(YearSem::class, 'Year_SemID');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentID');
    }

    public function courseInstructor()
    {
        return $this->belongsTo(CourseInstructor::class, 'Course_InstructorID');
    }
}
