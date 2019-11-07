<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';
    public $primaryKey = 'id';
    protected $fillable = [
        'city_name', 'slug', 'state','created_at','updated_at',
    ];
}
