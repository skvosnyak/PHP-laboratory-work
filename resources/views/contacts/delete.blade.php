@extends('contacts.layout')

@section('content')

@isset($deleted)
    <div class="deleted-msg">
        Запись с фамилией <strong>{{ $deleted }}</strong> удалена
    </div>
@endisset

<div class="contact-list">
    @forelse($contacts as $contact)
        <form method="POST" action="{{ route('contacts.destroy', $contact) }}" style="display:inline">
            @csrf
            <button type="submit"
                    style="background:#e8eaf6; color:#1a237e; border:2px solid transparent;
                           border-radius:4px; padding:5px 13px; font-size:0.88rem;
                           cursor:pointer; font-family:inherit; transition:border 0.15s"
                    onmouseover="this.style.borderColor='#c62828'"
                    onmouseout="this.style.borderColor='transparent'"
                    onclick="return confirm('Удалить {{ $contact->last_name }}?')">
                {{ $contact->short_name }}
            </button>
        </form>
    @empty
        <p style="color:#999">Контактов нет</p>
    @endforelse
</div>

@endsection
