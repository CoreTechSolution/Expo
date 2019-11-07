<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_user extends Model
{
    protected $table = 'event_user';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_id', 'user_id','user_type','user_name','user_email',
    ];
}
