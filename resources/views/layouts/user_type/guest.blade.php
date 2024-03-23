@extends('layouts.app')

    @if(\Request::is('login/forgot-password')) 
        @include('layouts.navbars.guest.nav')
        @yield('content') 
    @else
        @if(Request::is('send_verify_email'))
            <div class="container position-sticky z-index-sticky top-0">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.navbars.guest.nav')
                    </div>
                </div>
            </div>
        @endif
        @yield('content')        
       {{--  @include('layouts.footers.guest.footer') --}}
    @endif