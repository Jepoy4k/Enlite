<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class AllUsers extends Authenticatable
{
    protected $primaryKey = 'UserID';

    protected $fillable = [
        'RoleID', 'Username', 'Password',
    ];

    protected $hidden = [
        'Password', 'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    protected $table = 'all_users';

    public function setPasswordAttribute($value)
    {
        $this->attributes['Password'] = Hash::make($value);
    }
    public function student()

    {
        return $this->hasOne(Student::class, 'UserID', 'UserID');
    }


    public function instructor()

    {
        return $this->hasOne(Instructor::class, 'UserID', 'UserID');
    }


}
