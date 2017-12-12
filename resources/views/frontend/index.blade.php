@extends('frontend.layouts.app')

@section('content')

    <div class="index-frame">
        <div class="index-frame-timer-box">
            <div class="index-add-time-button-group">
                <button id="add-0" class="index-add-time-buttons">
                    0
                </button>
                <button id="add-10s" class="index-add-time-buttons">
                    +10s
                </button>
                <button id="add-30s" class="index-add-time-buttons">
                    +30s
                </button>
                <button id="add-1m" class="index-add-time-buttons">
                    +1m
                </button>
                <button id="add-5m" class="index-add-time-buttons">
                    +5m
                </button>
                <button id="add-10m" class="index-add-time-buttons">
                    +10m
                </button>
                <button id="add-30m" class="index-add-time-buttons">
                    +30m
                </button>
                <button id="add-1h" class="index-add-time-buttons">
                    +1h
                </button>
                <!-- <div class="index-add-time-buttons">
                    <input type="number" id="custom-input" value="10"/>
                </div> -->
            </div>
            <div class="index-countdown-line">
                <div id="index-countdown-line-bar"></div>
            </div>
            <div class="index-timer-container">
                <input type="text" id="input2" value="00:00:00" disabled/>
            </div>
            
            <div class="index-stop-start-container">
                <div class="index-stop-start-button-group">
                    <input class="index-stop-start-buttons" id="start-button" type="button" value="start"/>
                    <input class="index-stop-start-buttons" id="stop-button" type="button" value="stop"/>
                    <input class="index-stop-start-buttons" id="reset-button" type="button" value="reset@00:01:00"/>
                </div>
            </div>
            
            
        </div>
    </div>

            @guest
                <div><a href="{{route('frontend.auth.login')}}">Create an account</a> to set up accountability & stay focused!</div>
            @endauth

@endsection

@push('after-scripts')
    <script src="/js/timer.js"></script>
@endpush