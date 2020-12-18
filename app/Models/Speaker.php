<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Shipu\Watchable\Traits\WatchableTrait;

class Speaker extends Model
{
    use CrudTrait, WatchableTrait;

    protected $fillable = [
        'name',
        'slug',
        'photo_url',
        'designation',
        'company',
        'about',
        'email',
        'phone',
        'twitter',
        'facebook',
        'linkedin',
        'seo_keywords',
        'seo_description'
    ];

    public function session()
    {
        return $this->hasMany(\App\Models\Session::class);
    }
}
