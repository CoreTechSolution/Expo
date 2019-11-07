<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'pages';
    public $primaryKey = 'id';
    protected $fillable = [
        'page_name', 'slug', 'page_content','created_by','created_at','updated_at',
    ];

}
