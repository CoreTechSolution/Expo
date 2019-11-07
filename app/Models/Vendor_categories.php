<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor_categories extends Model
{
    protected $table = 'vendor_categories';
    public $primaryKey = 'id';
    protected $fillable = [
        'vendor_category_name', 'slug', 'vendor_category_descriptions','created_at','updated_at',
    ];
}
