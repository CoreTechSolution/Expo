<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    public $primaryKey = 'id';
    protected $fillable = [
        'event_vertical_id','event_title','event_headline', 'slug', 'event_description','event_date','event_time','event_location','event_country','event_city','attendees','exhibitors','event_url','event_phone','event_email','created_by','is_top','is_featured','status','created_at','updated_at','event_image','pdf_doc_upload',
    ];
}
