@extends('layouts.error')

@section('page_title', 'DB Error')

@section('content')
    <div class="error">
        <h1>500</h1>
        <h2>error</h2>
        <p>Uuh-Ooh, something just isn't right...</p>
        <p><small>It's not you, Its us. But we are working on it. Thanks.</small></p>
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
                                {{ $message }}
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
