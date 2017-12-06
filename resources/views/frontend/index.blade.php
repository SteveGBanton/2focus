@extends('frontend.layouts.app')

@section('content')

    <div class="index-timer">
        <div class="timer">
            <input type="number" id="input2" value="10" />
            <input id="start-button" type="button" value="start"/>
            <input id="stop-button" type="button" value="stop"/>
            <input id="reset-button" type="button" value="reset"/>
        </div>
    </div>

            @guest
                <div><a href="{{route('frontend.auth.login')}}">Create an account</a> to set up accountability & stay focused!</div>
            @endauth

            @auth
                <div>{{ auth()->user()->name }}</div>
            @endauth

@endsection

@push('after-scripts')
    <script src="/js/timer.js"></script>
@endpush