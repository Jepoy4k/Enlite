<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    use HasFactory;

    protected $table = 'course_instructor';

    protected $primaryKey = 'Course_InstructorID';

    public $incrementing = false;

    protected $keyType = 'bigint';

    public $timestamps = false;

    protected $fillable = [
        'Course_InstructorID',
        'InstructorID',
        'CourseID',
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'InstructorID');
    }

    public function course()
    {
        return $this->belongsTo(CourseManagement::class, 'CourseID');
    }
}
