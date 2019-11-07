<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_type extends Model
{
    protected $table = 'event_type';
    public $primaryKey = 'id';
    protected $fillable = [
        'name', 'slug','created_at','updated_at',
    ];
}
