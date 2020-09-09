@extends('layouts.error')

@section('page_title', 'Error 404')

@section('content')
    <div class="error">
        <h1>404</h1>
        <h2>Oops</h2>
        <p>Sorry, this page is missing!</p>
        <p><small>You are here because the page you are trying to reach is either removed or never existed.</small></p>
    </div>
    <div class="stack-container">
        @include('errors.body')
        <div class="card-container">
            <div class="perspec" style="--spreaddist: 0px; --scaledist: 1; --vertdist: 0px;">
                <div class="card">
                    <div class="writing">
                        <div class="topbar">
                            <div class="red"></div>
                            <div class="yellow"></div>
                            <div class="green"></div>
                        </div>
                        <div class="code">
                            <p style="padding: 10px; color: #fff">
                                click <b><a href="{{ route('home') }}">HOME</a></b> to return.
                            </p>
                            <p style="color: #ffa700">Sorry for any inconvenience </p>
                            <br>
                            <p style="color: #ffa700"> - {{ env('APP_NAME', 'Anonymous') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
