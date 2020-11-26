@extendS('emails.layout')

@section('content')
    <div style="Margin-left: 20px;Margin-right: 20px;">
        <div style="mso-line-height-rule: exactly;mso-text-raise: 4px;">
            <h1 style="Margin-top: 0;Margin-bottom: 0;font-style: normal;font-weight: normal;color: #14161e;font-size: 22px;line-height: 31px;font-family: Bitter,Georgia,serif;">
                Hello, {{ $attendee->name }}</h1>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">Please add your address to your registration profile to claim the DevCon'20 gift items.</p>    
            <p style="Margin-top: 20px;Margin-bottom: 20px;">Here is your profile update link. <a href="{{ route('attendee.update.form.show', ['code' => $attendee->hash_code]) }}">Click here</a> to update your profile.</p>
            <p style="Margin-top: 20px;Margin-bottom: 20px;">What is our plan?</p>
        </div>
    </div>
@endsection

@section('footer')
    You are receiving this because you are registered attendee in the {{ env('EVENT_TITLE') }} event.
@stop
