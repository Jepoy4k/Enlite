<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseManagement extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'course_management';

    // Primary key
    protected $primaryKey = 'CourseID';

    // Indicates if the IDs are auto-incrementing
    public $incrementing = false;

    // Key type
    protected $keyType = 'string';

    // Timestamps
    public $timestamps = false;

    // Mass assignable attributes
    protected $fillable = [
        'CourseID',
        'Description',
        'Credits',
    ];

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'course_instructor', 'CourseID', 'InstructorID')
                    ->wherePivot('Drop', 0);
    }
}
