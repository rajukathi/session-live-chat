@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            {{ __('Session Lists') }}         
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-end" href="{{ route('session.create') }}"> Add Session </a>                       
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th scope="col" width="50%">Session Name</th>
                            <th scope="col" width="10%">Start Time</th>
                            <th scope="col" width="10%">End Time</th>
                            <th scope="col" width="10%">Status</th>
                            <th scope="col" width="20%">Action</th>
                        </tr>
                        @if( $sessions )
                            @foreach( $sessions as $session )
                            <tr>
                                <td>
                                    {{ $session->name }}
                                </td>
                                <th scope="row">
                                    {{ $session->start_time }}
                                </th>
                                <th scope="row">
                                    {{ $session->end_time }}
                                </th>
                                <td>
                                    {{ ($session->is_active == 1) ? "Yes" : "No" }}                                
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('session.get', $session->id) }}"> Edit </a> ||
                                    <a class="btn btn-danger" href="{{ route('session.delete', $session->id) }}"> Delete </a> ||
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </table>

                    {{ $sessions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
