<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Записная книжка</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f9;
            color: #222;
            min-height: 100vh;
        }

        /* ── Меню ── */
        nav {
            background: #1a1a2e;
            padding: 12px 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        nav .site-title {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            margin-right: 16px;
        }

        /* Основные пункты меню */
        nav a.menu-item {
            display: inline-block;
            padding: 7px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            background: #1565c0;
            color: #fff;
            transition: background 0.15s;
        }

        nav a.menu-item:hover { background: #1976d2; }
        nav a.menu-item.active { background: #c62828; }

        /* Дополнительные пункты сортировки */
        .sort-bar {
            background: #16213e;
            padding: 8px 24px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            align-items: center;
        }

        .sort-bar span {
            color: #aaa;
            font-size: 0.82rem;
            margin-right: 4px;
        }

        .sort-bar a.sort-item {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 500;
            background: #1565c0;
            color: #fff;
            transition: background 0.15s;
        }

        .sort-bar a.sort-item:hover { background: #1976d2; }
        .sort-bar a.sort-item.active { background: #c62828; }

        /* ── Контент ── */
        main {
            max-width: 1100px;
            margin: 32px auto;
            padding: 0 24px;
        }

        /* ── Таблица ── */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }

        thead { background: #1a1a2e; color: #fff; }
        th, td { padding: 10px 12px; text-align: left; font-size: 0.9rem; }
        tbody tr:nth-child(even) { background: #f0f4ff; }
        tbody tr:hover { background: #e3eaff; }

        /* ── Пагинация ── */
        .pagination {
            margin-top: 20px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            display: inline-block;
            padding: 5px 11px;
            font-size: 0.88rem;
            text-decoration: none;
            color: #1565c0;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .pagination a:hover { border: 2px solid #1565c0; }
        .pagination span.current { background: #1565c0; color: #fff; border-radius: 4px; }

        /* ── Формы ── */
        .form-card {
            background: #fff;
            border-radius: 8px;
            padding: 28px 32px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            max-width: 640px;
        }

        .form-card h2 { margin-bottom: 20px; font-size: 1.2rem; color: #1a1a2e; }

        .form-group { margin-bottom: 14px; }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #555;
            margin-bottom: 4px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.9rem;
            background: #fafafa;
            transition: border 0.15s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1565c0;
            background: #fff;
        }

        .form-group textarea { resize: vertical; min-height: 80px; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        button[type=submit] {
            margin-top: 8px;
            padding: 9px 24px;
            background: #1565c0;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s;
        }

        button[type=submit]:hover { background: #1976d2; }

        /* ── Статусные сообщения ── */
        .msg-success { color: #2e7d32; font-weight: 600; margin-bottom: 14px; }
        .msg-error   { color: #c62828; font-weight: 600; margin-bottom: 14px; }

        /* ── Список контактов (edit/delete) ── */
        .contact-list {
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .contact-list a {
            display: inline-block;
            padding: 5px 13px;
            background: #e8eaf6;
            color: #1a237e;
            border-radius: 4px;
            text-decoration: none;
            font-size: 0.88rem;
            border: 2px solid transparent;
            transition: border 0.15s, background 0.15s;
        }

        .contact-list a:hover { border-color: #1565c0; }
        .contact-list a.active { background: #1565c0; color: #fff; }

        .deleted-msg {
            margin-bottom: 16px;
            padding: 10px 16px;
            background: #fff3e0;
            border-left: 4px solid #e65100;
            border-radius: 4px;
            font-size: 0.92rem;
        }
    </style>
</head>
<body>

{{-- ── Главное меню ── --}}
@php
    $currentRoute = request()->route()->getName();
@endphp

<nav>
    <span class="site-title">📒 Контакты</span>

    <a href="{{ route('contacts.index') }}"
       class="menu-item {{ str_starts_with($currentRoute, 'contacts.index') ? 'active' : '' }}">
        Просмотр
    </a>

    <a href="{{ route('contacts.create') }}"
       class="menu-item {{ str_starts_with($currentRoute, 'contacts.create') || $currentRoute === 'contacts.store' ? 'active' : '' }}">
        Добавление записи
    </a>

    <a href="{{ route('contacts.edit') }}"
       class="menu-item {{ str_starts_with($currentRoute, 'contacts.edit') || $currentRoute === 'contacts.update' ? 'active' : '' }}">
        Редактирование записи
    </a>

    <a href="{{ route('contacts.delete') }}"
       class="menu-item {{ str_starts_with($currentRoute, 'contacts.delete') || $currentRoute === 'contacts.destroy' ? 'active' : '' }}">
        Удаление записи
    </a>
</nav>

{{-- Подменю сортировки показывается только на странице просмотра --}}
@if(str_starts_with($currentRoute, 'contacts.index'))
@php $sort = request('sort', 'id'); @endphp
<div class="sort-bar">
    <span>Сортировка:</span>
    <a href="{{ route('contacts.index', ['sort' => 'id']) }}"
       class="sort-item {{ $sort === 'id' ? 'active' : '' }}">По порядку добавления</a>
    <a href="{{ route('contacts.index', ['sort' => 'last_name']) }}"
       class="sort-item {{ $sort === 'last_name' ? 'active' : '' }}">По фамилии</a>
    <a href="{{ route('contacts.index', ['sort' => 'birth_date']) }}"
       class="sort-item {{ $sort === 'birth_date' ? 'active' : '' }}">По дате рождения</a>
</div>
@endif

<main>
    @yield('content')
</main>

</body>
</html>
