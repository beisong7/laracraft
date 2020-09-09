@extends('layouts.error')

@section('page_title', 'Error 503')

@section('content')
    <div class="error">
        <h1>503</h1>
        <h2>error</h2>
        <p>Uuh-Ooh, something just isn't right...</p>
        <p><small>Our resources are unavailable at the moment, but this will be resolved soonest.</small></p>
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
                                We are restoring services... pls be patient
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
