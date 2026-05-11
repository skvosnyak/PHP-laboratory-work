@extends('contacts.layout')

@section('content')

{{-- Список контактов --}}
<div class="contact-list">
    @forelse($list as $item)
        <a href="{{ route('contacts.edit', ['id' => $item->id]) }}"
           class="{{ $contact && $contact->id === $item->id ? 'active' : '' }}">
            {{ $item->last_name }} {{ $item->first_name }}
        </a>
    @empty
        <p style="color:#999">Контактов нет</p>
    @endforelse
</div>

{{-- Форма --}}
@if($contact)
<div class="form-card">
    <h2>Редактирование: {{ $contact->full_name }}</h2>

    @isset($status)
        @if($status === 'success')
            <p class="msg-success">✓ Запись обновлена</p>
        @else
            <p class="msg-error">✗ Ошибка: запись не обновлена</p>
        @endif
    @endisset

    <form method="POST" action="{{ route('contacts.update', $contact) }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Фамилия *</label>
                <input type="text" name="last_name" value="{{ old('last_name', $contact->last_name) }}" required>
                @error('last_name')<span class="msg-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label>Имя *</label>
                <input type="text" name="first_name" value="{{ old('first_name', $contact->first_name) }}" required>
                @error('first_name')<span class="msg-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Отчество</label>
                <input type="text" name="middle_name" value="{{ old('middle_name', $contact->middle_name) }}">
            </div>
            <div class="form-group">
                <label>Пол *</label>
                <select name="gender" required>
                    <option value="M" {{ old('gender', $contact->gender) === 'M' ? 'selected' : '' }}>Мужской</option>
                    <option value="F" {{ old('gender', $contact->gender) === 'F' ? 'selected' : '' }}>Женский</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Дата рождения</label>
                <input type="date" name="birth_date"
                       value="{{ old('birth_date', $contact->birth_date?->format('Y-m-d')) }}">
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="text" name="phone" value="{{ old('phone', $contact->phone) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Адрес</label>
            <input type="text" name="address" value="{{ old('address', $contact->address) }}">
        </div>

        <div class="form-group">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email', $contact->email) }}">
            @error('email')<span class="msg-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label>Комментарий</label>
            <textarea name="comment">{{ old('comment', $contact->comment) }}</textarea>
        </div>

        <button type="submit">Сохранить</button>
    </form>
</div>
@else
    <p style="color:#999">Нет доступных записей для редактирования</p>
@endif

@endsection
