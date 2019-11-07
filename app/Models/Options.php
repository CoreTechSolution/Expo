<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table="options";
    public $prymarikey="id";
    protected $fillable=[
        'option_key','option_value','created_at','updated_at',
    ];
}
