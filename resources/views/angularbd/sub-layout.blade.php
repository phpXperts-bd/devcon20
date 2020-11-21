`@extends('angularbd.layout')

@section('main-content')
    <div class="Meetup">
        <header class="Meetup__header Meetup__header--ticket">
            <a class="Meetup__back" href="{{ route('angularbd.index') }}" ><img src="{{ asset('phpxperts/icons/back.svg') }}" alt=""></a>
            @include('angularbd.partials.logo')
        </header>

        @yield('content')

        <div class="Credit Credit--ticket">Prepared by <a href="https://www.facebook.com/zafree" target="_blank">Foysal Zafree</a>, <a href="https://www.facebook.com/to.shipu" target="_blank">Shipu Ahamed</a>, <a href="https://www.facebook.com/rafsanhashemi" target="_blank">Hashemi Rafsan</a></div>
    </div>
@endsection
