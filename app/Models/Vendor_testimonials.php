<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor_testimonials extends Model
{
    protected $table = 'vendor_testimonials';
    public $primaryKey = 'id';
    protected $fillable = [
        'vendor_id', 'user_name', 'user_image','content','created_at','updated_at',
    ];
}
