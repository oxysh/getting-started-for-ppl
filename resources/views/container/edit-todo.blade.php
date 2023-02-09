@extends('template.general')

{{-- HEAD --}}
@section('title', 'Edit Your To-do')

{{-- BODY --}}
{{-- @section('bodyclass', '...') --}}
@section('contentclass', 'add-edit-todo')

{{-- @section('navbar')
    ...
@endsection --}}

@section('content')
    <h1 class="add-edit-todo__title">Edit To-do</h1>
    <form action="{{ route('todo.update', $todo->id) }}" method="post" class="add-edit-todo__form">
        @csrf
        @method('PUT')
        <div class="add-edit-todo__desc">
            <input type="text" placeholder="Title" id="title" name="title"
                value="{{ old('title') ? old('title') : $todo->title }}"
                class="form-input form-input--text form-input--title">
            @if ($errors->has('title'))
                <h6 class="form-input__help">{{ $errors->first('title') }}</h6>
            @endif
            <textarea placeholder="Note" id="note" name="note" class="form-input form-input--text form-input--note"
                rows="4">{{ old('note') ? old('note') : $todo->note }}</textarea>
        </div>
        <div class="add-edit-todo__date-time">
            <input type="date" placeholder="Date" id="date" name="date"
                value="{{ old('date') ? old('date') : $todo->date }}" class="form-input form-input--text">
            <input type="time" placeholder="Time" id="time" name="time"
                value="{{ old('time') ? old('time') : $todo->time }}" class="form-input form-input--text">
        </div>
        <input type="text" placeholder="Place" id="place" name="place"
            value="{{ old('place') ? old('place') : $todo->place }}" class="form-input form-input--text">
        <div class="add-edit-todo__footer">
            <div class="content">
                <button type="submit" class="btn-primary add-edit-todo__btn-submit">submit</button>
            </div>
        </div>
    </form>
@endsection

{{-- @section('other')
    ...
@endsection --}}

{{-- @section('extrajs')
    ...
@endsection --}}
