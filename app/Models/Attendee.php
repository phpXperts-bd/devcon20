<?php

namespace App\Models;

use App\Jobs\SendEmailJob;
use App\Jobs\SendSmsJob;
use App\Mail\SuccessfullyCreateAttendee;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Shipu\Watchable\Traits\WatchableTrait;

class Attendee extends Model
{
    use CrudTrait, WatchableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'uuid',
        'type',
        'mobile',
        'email',
        'profession',
        'social_profile_url',
        'is_paid',
        'misc',
        'attend_at'
    ];

    protected $casts = [
        'misc' => 'array',
        'attend_at' => 'datetime'
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function getTshirtAttribute()
    {
        return \Arr::get($this->misc, 'tshirt', 'N/A');
    }

    public function getWorkingAttribute()
    {
        return \Arr::get($this->misc, 'working', 'N/A');
    }

    public function getInstructionAttribute()
    {
        return \Arr::get($this->misc, 'instruction', 'N/A');
    }

    public function onModelCreating()
    {
        $this->uuid = DB::raw('UUID()');
    }

    public function onModelCreated()
    {
        dispatch(new SendEmailJob($this, new SuccessfullyCreateAttendee($this)));
        if(env('SMS_ENABLED')) {
            dispatch(new SendSmsJob($this, ($this->type==\App\Enums\AttendeeType::ATTENDEE?env('CONFIRM_MESSAGE'):env('GUEST_MESSAGE'))));
        }
    }

    public function openPaymentPage()
    {
        if (!$this->is_paid) {
            return '<a class="btn btn-sm btn-link" target="_blank" href="'. route('ticket.payment', ['attendee' => $this->id]).'" data-toggle="tooltip" title="Payment"><i class="fa fa-money"></i> Payment</a>';
        }
    }

    public function setAttendAt()
    {
        if (blank($this->attend_at)) {
            return '<a class="btn btn-sm btn-link" href="'. route('set.attend_at', ['id' => $this->id]).'" data-toggle="tooltip" title="Payment"><i class="fa fa-money"></i> Attend</a>';
        }
    }
}
