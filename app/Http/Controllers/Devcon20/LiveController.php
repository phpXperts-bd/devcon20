<?php

namespace App\Http\Controllers\Devcon20;

use App\Http\Controllers\Controller;
use App\Enums\PaymentStatus;
use App\Http\Requests\AttendeeRequest;
use App\Jobs\SendEmailJob;
use App\Mail\SendProfileUpdateLink;
use App\Models\Attendee;
use App\Models\Payment;
use App\Enums\AttendeeType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LiveController extends Controller
{
    public function index()
    {
        return view('devcon20.app');
    }

    public function session()
    {
        return view('devcon20.session');
    }

    public function showLoginForm()
    {
        $attendeeType = AttendeeType::GUEST;

        return view('devcon20.login', compact('attendeeType'));
    }


    public function attendeeSignIn($hashCode, Request $request)
    {

        $attendee = Attendee::where('hash_code', $hashCode)->first();

        if (blank($attendee)) {
            toast('Invalid hashcode!', 'warning');
            return back();
        }

        Auth::loginUsingId($attendee->id);

        return redirect()->route('devcon20.index');
    }

    public function showAttendeeForm($code)
    {

        $attendeeType = AttendeeType::GUEST;

        $attendee = Attendee::where('hash_code', $code)->first();

        return view('angularbd.buy-ticket-edit', compact('attendeeType', 'attendee'));
    }

    public function storeNewRegistration(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'mobile' => ['required']
        ]);

        if ($validation->fails()) {
            return back();
        }

        $isExistsAttendee = Attendee::query()
                            ->where('email', $request->input('email'))
                            ->exists();

        if (! $isExistsAttendee) {
            $attendee = Attendee::create(array_merge(
                $request->only(['name', 'email', 'mobile']),
                [
                    'misc' => [
                        'live_attendee' => true
                    ],
                    'hash_code' => Str::random(20),
                    'hash_code_duration' => Carbon::now()->addDays(5)
                ]
            ));

            if (! $attendee) {
                toast('Something went wrong, please try again', 'warning');
                return back();
            }

            toast(env('SUCCESSFUL_REGISTRATION_MESSAGE'), 'success');
            return back();
        }

        toast('Already Registered', 'warning');
        return back();
    }
}
