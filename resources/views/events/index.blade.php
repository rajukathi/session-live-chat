@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            {{ __('Event Lists') }}         
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-end" href="{{ route('event.create') }}"> Add Event </a>                       
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col" width="15%">Event Date</th>
                            <th scope="col" width="45%">Event Name</th>
                            <th scope="col" width="10%">Status</th>
                            <th scope="col" width="30%">Action</th>
                        </tr>
                        @if( $events )
                            @foreach( $events as $event )
                            <tr>
                                <th scope="row">
                                    {{ $event->event_date }}
                                </th>
                                <td>
                                    {{ $event->name }}
                                </td>
                                <td>
                                    {{ ($event->is_active == 1) ? "Yes" : "No" }}                                
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('event.get', $event->id) }}"> Edit </a> ||
                                    <a class="btn btn-danger" href="{{ route('event.delete', $event->id) }}"> Delete </a> ||
                                    <a class="btn btn-primary" href="{{ route('session.create', $event->id) }}"> Create Session </a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>

                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
