<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'NotificationID';
    public $timestamps = true;

    protected $fillable = [
        'UserID',
        'Message',
    ];

    protected $dates = [
        'created_at',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(AllUsers::class, 'UserID', 'UserID');
    }
}
