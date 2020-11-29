@extendS('emails.layout')

@section('content')
    <div style="Margin-left: 20px;Margin-right: 20px;">
        <div style="mso-line-height-rule: exactly;mso-text-raise: 4px;">
            <h1 style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #14161e;font-size: 22px;line-height: 31px;font-family: Bitter,Georgia,serif;">
                Hello, {{ $attendee->name }}</h1>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">Please add your address to your registration profile to claim the DevCon'20 gift items.</p>    
            <p style="Margin-top: 20px;Margin-bottom: 20px;">Here is your profile update link. <a href="{{ route('attendee.update.form.show', ['code' => $attendee->hash_code]) }}">Click here</a> to update your profile.</p>
            <p style="Margin-top: 20px;font-style: normal;font-weight: normal;color: #14161e;font-size: 22px;line-height: 31px;font-family: Bitter,Georgia,serif;">What is our plan?</p>
            <p style="Margin-bottom: 20px;">
            As you know we have been going through COVID situation with so many challenges, we eagerly waiting like anyone to see the end and it seems like it will pass this year. 
            <br>
            We hardly see a way to arrange DevCon 2020 physically and as a patron of the event, still you waiting and so we; so here are the plans,
            </p>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">
-       We do the DevCon’20 at online with all your faborite speakers, a huge preparation and hard work are in progress, the date will be announced soon.
            </p>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">
-       We got Pathao as our logistics sponsor this week, so we ship everyone’s (already registered attendees) gift to their home address, gifts are t-shirt as given size, notebook, sticker, messenger bag, all of them got DevCon and Sponsors logo printed.
            </p>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">
-       The event will be broadcasted from <strong>phpXperts.net</strong> website.
            </p>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">
-       All the recordings will be published on phpXperts YouTube channel and will be there for reference and learning always.
            </p>
        </div>
    </div>
@endsection

@section('footer')
    You are receiving this because you are registered attendee in the {{ env('EVENT_TITLE') }} event.
@stop
