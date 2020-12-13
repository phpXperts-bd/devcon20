<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-title">Administration</li>
@if(auth()->guard('backpack')->user()->email === env('ADMIN_EMAIL'))
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attendee') }}'><i class='nav-icon fa fa-question'></i> Attendees</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('payment') }}'><i class='nav-icon fa fa-question'></i> Payments</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('session') }}'><i class='nav-icon fa fa-question'></i> Sessions</a></li>
    <li class='nav-item'><a class='nav-link' href='{{ backpack_url('speaker') }}'><i class='nav-icon fa fa-question'></i> Speakers</a></li>
@endif
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('opening') }}'><i class='nav-icon fa fa-question'></i> Opening</a></li>

