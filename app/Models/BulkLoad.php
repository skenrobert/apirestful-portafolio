<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BulkLoad extends Model
{
    // use SoftDeletes;

    protected $table = "bulk_load";
    
    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'document_number',
        'name',
        'start',
        'end',
        'nickname_mfc',
        'token_mfc',
        'nickname_chat',
        'token_chat',
        'nickname_stripchat',
        'token_stripchat',
        'token_camsoda',
        'nickname_bongas',
        'token_bongas',
        'nickname_cam4',
        'token_cam4',
        'nickname_jasmin',
        'token_jasmin',
        'nickname_streamate',
        'token_streamate',
        'nickname_manyvids',
        'token_manyvids',
        'nickname_naked',
        'token_naked',
        'nickname_youporn',
        'token_youporn',
        'nickname_dirty',
        'token_dirty',
        'retefuente'
    
    ];

   
    // use Sluggable;

    //     public function sluggable(){// el slug para url amigables tienen vista al usuario visitante todos los slug
    //         return [
    //             'slug' => [
    //                 'source' => 'nickname'
    //             ]
    //         ];
    //     }

 

    public function accounting() //1 a m
    {
        return $this->belongsTo('App\Models\Accounting');
    }

    public function site() //1 a m
    {
        return $this->belongsTo('App\Models\Site');
    }

}
