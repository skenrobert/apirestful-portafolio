<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    

    use SoftDeletes;

    protected $table = "polls";
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'webcam_model',
        'does_anal',
        'tattoos',
        'smoke',
        'sex_toys',
        'pubic_hair',
        'lactation',
        'piercings',
        'number_children',
        'weight',
        'pages_worked',
        'like_sexually',
        'turns_on_sexually',
        'turns_off_sexually',
        'zodiac_sign',
        'occupation',
        'height',
        'eye_color',
        'bust_size',
        'hip_size',
        'blocked_countries',
        'sexual_preference',
        'civil_status',
        'favorite_color',
        'english_level',
        'hair_color',
        'waist_size',
        'hobby',
        'nick_suggestion',
        'user_id',
        'company_id',
            ];


    public function company()//m a n
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function user()//m a n
    {
        return $this->belongsTo('App\Models\User');
    }
    

}
