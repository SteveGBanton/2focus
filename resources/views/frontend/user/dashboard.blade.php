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
                    <div class="row text-center center-block">
                        <div class="col-md-12">

                            @include('frontend.includes.paginate-links')
                    
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
                                <div>No sessions to display - <a href="{{route('frontend.index')}}">start a focus session</a></div>
                            @endforelse

                            @include('frontend.includes.paginate-links')

                        </div><!--col-md-8-->
                    </div><!-- row -->
                </div> <!-- card-body -->
            </div><!-- card -->
        </div><!-- row -->
    </div><!-- row -->
@endsection
