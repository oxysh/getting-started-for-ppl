@extends('template.general')

{{-- HEAD --}}
@section('title', 'Welcome! - To-do List')

{{-- BODY --}}
{{-- @section('bodyclass', '...') --}}
@section('contentclass', 'landing')

{{-- @section('navbar')
    ...
@endsection --}}

@section('content')
    <h1 class="landing__title">My To-Do List</h1>
    <h1 class="add-edit-todo__title">TROLOLOLOL</h1>
    @if (count($todo) > 0)
        @foreach ($todo as $item)
            <div class="landing__todo-container">
                <form action="{{ route('todo.update', $item->id) }}" method="post" class="landing__todo-checklist">
                    @csrf
                    @method('PUT')
                    <input type="checkbox" name="checklist" id="checklist" class="landing__checklist"
                        @if ($item->checklist) checked @endif hidden>
                    <div class="landing__checklist--modified"></div>
                    <input type="submit" hidden>
                </form>
                <div class="landing__todo-content" onclick="window.location.href='{{ route('todo.edit', $item->id) }}'">
                    <h3>{{ $item->title }}</h3>
                    @if ($item->note)
                        <h4 class="landing__todo-note">
                            @foreach ($item->note as $x)
                                {{ $x }} <br>
                            @endforeach
                        </h4>
                    @endif
                    <p>
                        @if ($item->date)
                            {{ date('d M Y', strtotime($item->date)) }}
                        @endif
                        @if ($item->time)
                            at {{ date('h:i a', strtotime($item->time)) }}
                        @endif
                    </p>
                    @if ($item->place)
                        <p class="landing__todo-place"> <img src="{{ url('assets/img/location.svg') }}" alt="">
                            {{ $item->place }}</p>
                    @endif
                </div>
                <button class="btn-image landing__todo-delete" data-action="{{ route('todo.destroy', $item->id) }}"
                    data-title="{{ $item->title }}"><img src="{{ url('assets/img/delete.svg') }}"></button>
            </div>
        @endforeach
    @else
        <h4 class="landing__no-todo">
            Add your to-do, and it will show here!
        </h4>
    @endif
@endsection

@section('other')
    <div class="landing__footer-container">
        <div class="content landing__footer">
            <form action="{{ route('todo.store') }}" method="post" class="landing__footer-add-note">
                @csrf
                <input type="text" placeholder="Add Your To-do Quickly" id="title" name="title">
                <input type="submit" hidden>
            </form>
            <a href="{{ route('todo.create') }}" class="button btn-primary landing__footer-add-btn"><img
                    src="{{ url('assets/img/add.svg') }}" alt=""></a>
        </div>
    </div>

    <form action="" method="POST" class="dialog dialog--todo-delete">
        @csrf
        @method('delete')
        <h4 class="dialog__title">Yakin Ingin Menghapus?</h4>
        <p class="dialog__text">Jika anda menghapus to-do <span>title</span> maka anda tidak dapat mengembalikannya lagi.
        </p>
        <div class="dialog__btns">
            <span class="button btn-primary dialog__cancel">Batal</span>
            <button type="submit" class="btn-secondary">Iya, Hapus</button>
        </div>
    </form>

    <div class="dialog__bg"></div>
@endsection

@section('extrajs')
    <script>
        // modif checklist 1st load page
        $('.landing__checklist').each(x => {
            if ($('.landing__checklist')[x].checked) {
                $('.landing__checklist--modified')[x].classList.add('active');
            }
        })

        // modif checklist when clicked
        $('.landing__checklist--modified').click(function() {
            if ($(this)[0].previousElementSibling.checked) {
                $(this)[0].classList.remove('active');
                $(this)[0].previousElementSibling.checked = false;
            } else {
                $(this)[0].classList.add('active');
                $(this)[0].previousElementSibling.checked = true;
            }

            // checklist auto update
            form = $(this).closest('form');
            form.find('input[type=submit]').click();
        })

        $('.landing__footer-add-note').focusin(() => {
            $('.landing__footer-add-btn')[0].classList.add('active');
            $('.landing__footer-add-note')[0].classList.add('active');
        })
        $('.landing__footer-add-note').focusout(() => {
            $('.landing__footer-add-btn')[0].classList.remove('active');
            $('.landing__footer-add-note')[0].classList.remove('active');
        })

        // delete dialog
        $('.landing__todo-delete').click(e => {
            $('.dialog--todo-delete')[0].classList.add('active')
            data = e.currentTarget.dataset;
            $('.dialog--todo-delete').attr('action', data.action)
            $('.dialog--todo-delete .dialog__text span')[0].innerText = data.title
        })

        $('.dialog__cancel').click(function() {
            $(this).closest('form')[0].classList.remove('active');
        })
    </script>
@endsection
