@extends('contacts.layout')

@section('content')
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Дата рождения</th>
            <th>Телефон</th>
            <th>Адрес</th>
            <th>E-mail</th>
            <th>Комментарий</th>
        </tr>
    </thead>
    <tbody>
        @forelse($contacts as $i => $c)
        <tr>
            <td>{{ $contacts->firstItem() + $i }}</td>
            <td>{{ $c->last_name }}</td>
            <td>{{ $c->first_name }}</td>
            <td>{{ $c->middle_name ?? '—' }}</td>
            <td>{{ $c->gender === 'M' ? 'Муж.' : 'Жен.' }}</td>
            <td>{{ $c->birth_date?->format('d.m.Y') ?? '—' }}</td>
            <td>{{ $c->phone ?? '—' }}</td>
            <td>{{ $c->address ?? '—' }}</td>
            <td>{{ $c->email ?? '—' }}</td>
            <td>{{ $c->comment ?? '—' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="10" style="text-align:center; color:#999; padding:24px">
                Записей нет
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Пагинация --}}
@if($contacts->lastPage() > 1)
<div class="pagination">
    {{-- Предыдущая --}}
    @if($contacts->onFirstPage())
        <span>&laquo;</span>
    @else
        <a href="{{ $contacts->previousPageUrl() }}">&laquo;</a>
    @endif

    {{-- Номера страниц --}}
    @for($page = 1; $page <= $contacts->lastPage(); $page++)
        @if($page === $contacts->currentPage())
            <span class="current">{{ $page }}</span>
        @else
            <a href="{{ $contacts->url($page) }}">{{ $page }}</a>
        @endif
    @endfor

    {{-- Следующая --}}
    @if($contacts->hasMorePages())
        <a href="{{ $contacts->nextPageUrl() }}">&raquo;</a>
    @else
        <span>&raquo;</span>
    @endif
</div>
@endif

@endsection
