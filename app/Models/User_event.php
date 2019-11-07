<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_event extends Model
{
    protected $table = 'user_event';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_id', 'user_id', 'type','created_at','updated_at',
    ];
}
