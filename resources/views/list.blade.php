@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @if( $events )
                            @foreach( $events as $event )
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#coll_{{ $event->id }}" aria-expanded="true" aria-controls="coll_{{ $event->id }}">
                                            {{ $event->name }}    
                                        </button>
                                    </h2>
                                    <div id="coll_{{ $event->id }}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <center>{{ substr($event->description, 0, 200) }}...</center> 
                                            <hr>
                                            @foreach( $event->sessions as $session )
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <strong>{{ $session->name }}</strong>
                                                    </div>
                                                    <div class="col-md-2">{{ date('h:i', strtotime($session->start_time)) }}</div>
                                                    <div class="col-md-2">{{ date('h:i', strtotime($session->end_time)) }}</div>
                                                    <div class="col-md-2">
                                                        <a href="{{ route('join-session',[$session->event_id,$session->id]) }}" class="btn btn-primary"> Join Session </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>    
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
