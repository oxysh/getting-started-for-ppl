@extends('template.general')

{{-- HEAD --}}
@section('title', 'Add Your To-do')

{{-- BODY --}}
{{-- @section('bodyclass', '...') --}}
@section('contentclass', 'add-edit-todo')

{{-- @section('navbar')
    ...
@endsection --}}

@section('content')
    <h1 class="add-edit-todo__title">Add To-do</h1>
    <form action="{{ route('todo.store') }}" method="post" class="add-edit-todo__form">
        @csrf
        <div class="add-edit-todo__desc">
            <input type="text" placeholder="Title" id="title" name="title"
                class="form-input form-input--text form-input--title">
            @if ($errors->has('title'))
                <h6 class="form-input__help">{{ $errors->first('title') }}</h6>
            @endif
            <textarea placeholder="Note" id="note" name="note" class="form-input form-input--text form-input--note"
                rows="4"></textarea>
        </div>
        <div class="add-edit-todo__date-time">
            <input type="date" placeholder="Date" id="date" name="date" class="form-input form-input--text">
            <input type="time" placeholder="Time" id="time" name="time" class="form-input form-input--text">
        </div>
        <input type="text" placeholder="Place" id="place" name="place" class="form-input form-input--text">
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
