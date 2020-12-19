@extends('devcon20.layout')

@section('main-content')

    @if(auth()->check())
        @include('devcon20.partials.topbar-loggedin')
    @else
        @include('devcon20.partials.topbar')
    @endif

    <main>
    @include('devcon20.partials.player')

    @include('devcon20.partials.timeline')

    @include('devcon20.partials.sponsors')

    </main>

    @include('devcon20.partials.footer')

    @include('devcon20.partials.footer-js')

    @include('devcon20.partials.menu')

    @include('devcon20.partials.extra')
@endsection
