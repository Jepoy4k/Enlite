<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearSemester extends Model
{
    use HasFactory;

    // Specify the primary key for the table
    protected $primaryKey = 'Year_SemID';

    // Indicate that the primary key is not auto-incrementing if it's not the default 'id'
    public $incrementing = false;

    // The primary key is a big integer (for Laravel >= 6.0)
    protected $keyType = 'bigint';

    // Disable Laravel's timestamps feature (created_at, updated_at)
    public $timestamps = false;

    // Specify the table name if it's different from the pluralized model name
    protected $table = 'year_semester';

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'Year_SemID',
        'YearLevel',
        'Sem',
    ];
}
