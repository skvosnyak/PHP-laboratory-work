@extends('contacts.layout')

@section('content')
    <div class="form-card">
        <h2>Добавление записи</h2>

        @isset($status)
            @if($status === 'success')
                <p class="msg-success">✓ Запись добавлена</p>
            @else
                <p class="msg-error">✗ Ошибка: запись не добавлена</p>
            @endif
        @endisset

        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Фамилия *</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')<span class="msg-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label>Имя *</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')<span class="msg-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Отчество</label>
                    <input type="text" name="middle_name" value="{{ old('middle_name') }}">
                </div>
                <div class="form-group">
                    <label>Пол *</label>
                    <select name="gender" required>
                        <option value="">— выберите —</option>
                        <option value="M" {{ old('gender') === 'M' ? 'selected' : '' }}>Мужской</option>
                        <option value="F" {{ old('gender') === 'F' ? 'selected' : '' }}>Женский</option>
                    </select>
                    @error('gender')<span class="msg-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Дата рождения</label>
                    <input type="date" name="birth_date" value="{{ old('birth_date') }}">
                </div>
                <div class="form-group">
                    <label>Телефон</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+7 (999) 000-00-00">
                </div>
            </div>

            <div class="form-group">
                <label>Адрес</label>
                <input type="text" name="address" value="{{ old('address') }}">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')<span class="msg-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Комментарий</label>
                <textarea name="comment">{{ old('comment') }}</textarea>
            </div>

            <button type="submit">Добавить</button>
        </form>
    </div>
@endsection
