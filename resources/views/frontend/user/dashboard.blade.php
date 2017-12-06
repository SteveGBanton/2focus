@extends('frontend.layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        <i class="fa fa-dashboard"></i>&nbsp;&nbsp;&nbsp;{{ __('navs.frontend.dashboard') }}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col col-sm-4 order-1 order-sm-2 mb-4">
                            <div class="card mb-4 bg-light">
                                <img class="card-img-top" src="{{ $logged_in_user->picture }}" alt="Profile Picture">

                                <div class="card-body">
                                    <h4 class="card-title">
                                        {{ $logged_in_user->name }}<br/>
                                    </h4>

                                    <p class="card-text">
                                        <small>
                                            <i class="fa fa-envelope-o"></i> {{ $logged_in_user->email }}<br/>
                                            <i class="fa fa-calendar-check-o"></i> {{ __('strings.frontend.general.joined') }} {{ $logged_in_user->created_at->timezone(get_user_timezone())->format('F jS, Y') }}
                                        </small>
                                    </p>

                                    <p class="card-text">

                                        <a href="{{ route('frontend.user.account')}}" class="btn btn-info btn-sm mb-1">
                                            <i class="fa fa-user-circle-o"></i> {{ __('navs.frontend.user.account') }}
                                        </a>

                                        @can('view backend')
                                            &nbsp;<a href="{{ route ('admin.dashboard')}}" class="btn btn-danger btn-sm mb-1">
                                                <i class="fa fa-user-secret"></i> {{ __('navs.frontend.user.administration') }}
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>

                            
                        </div><!--col-md-4-->

                        <div class="col-md-8 order-2 order-sm-1">


                            @forelse ($timerSessions as $one)
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-4">
                                            <div class="card-header {{ ($one->success == 0 || $one->success == false) ? 'bgcolor-failure' : 'bgcolor-success' }}">
                                                Session ID {{ $one->id }} - ended {{ $one->created_at->setTimezone('UTC')->diffForHumans() }}
                                            </div><!--card-header-->

                                            <div class="card-body display-stats">
                                                <div>
                                                    <p>Target Length: {{ seconds_to_minutes_seconds(floor(($one->target_length)/1000)) }}</p>
                                                    <p>Time Focused: {{ seconds_to_minutes_seconds(floor(($one->focused_length)/1000)) }}</p>
                                                </div>
                                                <div>
                                                    <p>Successful Session? {{ ($one->success == 0 || $one->success == false) ? 'No' : 'Yes'  }}</p>
                                                    <p>Billed: ${{ $one->bill_amt }}</p>
                                                </div>
                                            </div><!--card-body-->
                                        </div><!--card-->
                                    </div><!--col-md-6-->
                                </div><!--row-->
                            @empty
                                <div>No Sessions Started - <a href="{{route('frontend.index')}}">Start A Session</a></div>
                            @endforelse

                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
