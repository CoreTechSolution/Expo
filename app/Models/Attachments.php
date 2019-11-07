<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    protected $table = 'attachments';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_id', 'image_name', 'image_path','image_alt','created_by','created_at','updated_at',
    ];
}
