<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    
    
    protected $table = "articles";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'text',
        'company_id',
        'category_id'
    ];

    public function tag()//m a n
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

}
