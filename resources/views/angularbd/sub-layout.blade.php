`@extends('angularbd.layout')

@section('main-content')
    <div class="Meetup">
        <header class="Meetup__header Meetup__header--ticket">
            <a class="Meetup__back" href="{{ route('angularbd.index') }}" ><img src="{{ asset('phpxperts/icons/back.svg') }}" alt=""></a>
            @include('angularbd.partials.logo')
        </header>

        @yield('content')

        <div class="Credit Credit--ticket">Crafted by <a href="https://www.facebook.com/zafree" target="_blank">Zafree</a></div>
    </div>
@endsection
