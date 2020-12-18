<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Shipu\Watchable\Traits\WatchableTrait;
use App\Casts\Json;
use Illuminate\Support\Facades\Log;

class Session extends Model
{
    use CrudTrait, WatchableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'title',
        'slug',
        'recording_url',
        'description',
        'active',
        'start_time',
        'end_time',
        'speakers',
        'slide_url',
        'codebase_url',
        'seo_keywords',
        'seo_description'
    ];

    protected $casts = [
        'speakers' => Json::class,
        'start_time' => 'datetime:dd-mm-yyyy H:i:s',
        'end_time' => 'datetime:dd-mm-yyyy H:i:s'
    ];

    public function speakers()
    {
        return $this->hasMany(\App\Models\Speaker::class);
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = Carbon::parse($value);
    }

    public function getSpeakersAttribute()
    {
        return json_decode($this->attributes['speakers']);
    }

    public function setSpeakersAttribute($value)
    {
        $this->attributes['speakers'] = json_encode($value);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = Carbon::parse($value);
    }
}
