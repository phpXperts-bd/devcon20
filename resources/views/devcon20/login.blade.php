@extends('devcon20.sub-layout')

@section('content')
<main class="Meetup__ticket">

    @if($attendeeType == \App\Enums\AttendeeType::SPONSOR || $attendeeType == \App\Enums\AttendeeType::VOLUNTEER || $attendeeType == \App\Enums\AttendeeType::GUEST)
    <h4 class="Meetup__sectionTitle">Delighted to have you here, please update yourself.</h4>
    @endif

    <p class="Meetup__sectionCopy"></p>
    <form class="Meetup__form" action="{{ route('attendee.login.post') }}" method="post" id="buyTicket">
        @csrf

        <div class="Field {{ $errors->has('hash_code') ? ' Field--error' : '' }}">
            <label class="Field__label">Hash</label>
            <div class="Field__control">
              <input class="Field__input" name="hash_code" id="hash_code" type="password" placeholder="Hash Code">
            </div>
            @if($errors->has('hash_code'))
            <p class="Field__validation">{{ $errors->first('hash_code') }}</p>
          @endif
        </div>


        <div class="Field Field--block">
          <button type="submit" class="Button Button--submit">Login</button>
        </div>
    </form>
</main>

@endsection
