<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_meta extends Model
{
    protected $table = 'event_meta';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_id', 'meta_key', 'meta_value',
    ];
}
