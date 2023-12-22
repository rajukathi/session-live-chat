@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            {{ __('Edit Session') }}
                        </div>
                        <div class="col-md-4">
                            <a class="btn btn-primary float-end" href="{{ route('session.index') }}"> <- Back To Session </a>                       
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="error">:message</div>')) !!}
                    @endif
                    <form method="POST" action="{{ route('session.save') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="event_id" class="col-md-3 col-form-label text-md-end">{{ __('Event') }}</label>
                            <div class="col-md-9">
                                <select id="event_id" class="form-control" name="event_id">
                                    <option value="">-- Select Event --</option>
                                    @if( $events )
                                        @foreach( $events as $event )
                                            <option value="{{ $event->id }}" {{ $event->id == $session->event_id ? "selected='selected'" : "" }}>{{ $event->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Session Name') }}</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $session->name }}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="event_date" class="col-md-3 col-form-label text-md-end">{{ __('Start Time') }}</label>
                            <div class="col-md-9">
                                <input id="event_date" type="text" class="form-control datetimepicker" name="start_time" value="{{ $session->start_time }}">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="event_date" class="col-md-3 col-form-label text-md-end">{{ __('End Time') }}</label>
                            <div class="col-md-9">
                                <input id="event_date" type="text" class="form-control datetimepicker" name="end_time" value="{{ $session->end_time }}">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $session->is_active == true ? 'checked' : '' }}>

                                    <label class="form-check-label" for="is_active">
                                        {{ __('Is Event Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">{{ __('Session Description') }}</label>
                            <div class="col-md-9">
                                <textarea id="description" type="text" class="form-control" name="description">
                                    {{ $session->description }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 $(function () {
     $('.datetimepicker').datetimepicker();
 });
</script>
@endsection
