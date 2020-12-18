@extends('angularbd.sub-layout')

@section('content')
    <main class="Meetup__ticket">

        @if($attendeeType == \App\Enums\AttendeeType::SPONSOR || $attendeeType == \App\Enums\AttendeeType::VOLUNTEER || $attendeeType == \App\Enums\AttendeeType::GUEST)
            <h4 class="Meetup__sectionTitle">Delighted to have you here, please update yourself.</h4>
        @endif

        <p class="Meetup__sectionCopy"></p>
        <form class="Meetup__form" action="{{ route('attendee.send.profile.link') }}" method="post" id="buyTicket">
            @csrf

            <div class="Field {{ $errors->has('email') ? ' Field--error' : '' }}">
                <label class="Field__label">Email</label>
                <div class="Field__control">
                    <input class="Field__input" name="email" id="email" type="email" placeholder="Email">
                </div>
                @if($errors->has('email'))
                    <p class="Field__validation">{{ $errors->first('email') }}</p>
                @endif
            </div>


            <div class="Field Field--block">
                <button type="submit" class="Button Button--submit">Send Update Link</button>
            </div>
        </form>
    </main>

@endsection
