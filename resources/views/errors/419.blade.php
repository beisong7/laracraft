@extends('layouts.error')

@section('page_title', 'Error 419')

@section('content')
    <div class="error">
        <h3>Session Expired</h3>
        <p>Your Session has Ended</p>
        <p><small>You are here because your precious session expired. click <a href="{{ route('home') }}" style="color: #ffa700"><b>HERE</b></a> to return <b>Home</b>.</small></p>
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
                                Your session expired. click the link provided to resolve this.
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
