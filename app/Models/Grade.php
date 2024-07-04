<?php

// app/Models/Grade.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';

    protected $primaryKey = 'GradeID';

    protected $fillable = [
        'StudentID',
        'Course_InstructorID',
        'Midterm',
        'Final',
        'Remarks'
    ];

    public function setRemarksAttribute()
    {
        if (($this->Midterm + $this->Final) / 2 <= 3.00) {
            $this->attributes['Remarks'] = 'Passed';
        } else {
            $this->attributes['Remarks'] = 'Failed';
        }
    }

    public $timestamps = false;

    // Ensure that the remarks are calculated when updating or creating a grade
    protected static function booted()
    {
        static::saving(function ($grade) {
            $grade->setRemarksAttribute();
        });
    }
}

