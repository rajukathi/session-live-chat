@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Events') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="error">:message</div>')) !!}
                    @endif
                    <form method="POST" action="{{ route('event.save') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Event Name') }}</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="event_date" class="col-md-3 col-form-label text-md-end">{{ __('Event Date') }}</label>
                            <div class="col-md-9">
                                <input id="event_date" type="text" class="form-control datetimepicker" name="event_date" value="{{ $event->event_date }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-9 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ $event->is_active ? 'checked' : '' }}>

                                    <label class="form-check-label" for="is_active">
                                        {{ __('Is Event Active') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">{{ __('Event Description') }}</label>
                            <div class="col-md-9">
                                <textarea id="description" type="text" class="form-control" name="description">
                                    {{ $event->description }}
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
