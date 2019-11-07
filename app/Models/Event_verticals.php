<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event_verticals extends Model
{
    protected $table = 'event_verticals';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_verticals_name', 'slug', 'event_verticals_descriptions','created_at','updated_at',
    ];
}
