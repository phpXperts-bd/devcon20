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

class LiveController extends Controller
{
    public function index()
    {
        return view('devcon20.app');
    }

    public function showLoginForm()
    {
        $attendeeType = AttendeeType::GUEST;

        return view('devcon20.login', compact('attendeeType'));
    }


    public function attendeeSignIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hash_code' => ['required', 'string', 'min:20']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $attendee = Attendee::where('hash_code', $request->input('hash_code'))->first();

        if (blank($attendee)) {
            toast('Invalid hashcode!', 'warning');
            return back();
        }

        Auth::loginUsingId($attendee->id);

        return redirect()->route('attendee.update.form.show');
    }

    public function showAttendeeForm($code)
    {

        $attendeeType = AttendeeType::GUEST;

        $attendee = Attendee::where('hash_code', $code)->first();

        return view('angularbd.buy-ticket-edit', compact('attendeeType', 'attendee'));
    }
}
