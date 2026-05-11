<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private const PER_PAGE = 10;

    // ── Просмотр ─────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        // sort: 'id' (по умолчанию), 'last_name', 'birth_date'
        $sort = in_array($request->get('sort'), ['last_name', 'birth_date'])
            ? $request->get('sort')
            : 'id';

        $contacts = Contact::orderBy($sort)
            ->paginate(self::PER_PAGE)
            ->withQueryString();

        return view('contacts.index', compact('contacts', 'sort'));
    }

    // ── Добавление ───────────────────────────────────────────────────────────

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'last_name'   => 'required|string|max:100',
            'first_name'  => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'gender'      => 'required|in:M,F',
            'birth_date'  => 'nullable|date',
            'phone'       => 'nullable|string|max:30',
            'address'     => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:100',
            'comment'     => 'nullable|string',
        ]);

        try {
            Contact::create($validated);
            $status = 'success';
        } catch (\Exception $e) {
            $status = 'error';
        }

        return view('contacts.create', compact('status'));
    }

    // ── Редактирование ────────────────────────────────────────────────────────

    public function edit(Request $request)
    {
        // Список всех контактов отсортированных по фамилии, имени
        $list = Contact::orderBy('last_name')->orderBy('first_name')->get();

        // Выбранный — из GET, иначе первый
        $selectedId = $request->get('id', $list->first()?->id);
        $contact = $list->firstWhere('id', $selectedId) ?? $list->first();

        return view('contacts.edit', compact('list', 'contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'last_name'   => 'required|string|max:100',
            'first_name'  => 'required|string|max:100',
            'middle_name' => 'nullablez|string|max:100',
            'gender'      => 'required|in:M,F',
            'birth_date'  => 'nullable|date',
            'phone'       => 'nullable|string|max:30',
            'address'     => 'nullable|string|max:255',
            'email'       => 'nullable|email|max:100',
            'comment'     => 'nullable|string',
        ]);

        try {
            $contact->update($validated);
            $status = 'success';
        } catch (\Exception $e) {
            $status = 'error';
        }

        $list = Contact::orderBy('last_name')->orderBy('first_name')->get();

        return view('contacts.edit', [
            'list'     => $list,
            'contact'  => $contact->fresh(),
            'status'   => $status,
        ]);
    }

    // ── Удаление ──────────────────────────────────────────────────────────────

    public function deleteIndex()
    {
        $contacts = Contact::orderBy('last_name')->orderBy('first_name')->get();
        return view('contacts.delete', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $lastName = $contact->last_name;

        try {
            $contact->delete();
            $deleted = $lastName;
        } catch (\Exception $e) {
            $deleted = null;
        }

        $contacts = Contact::orderBy('last_name')->orderBy('first_name')->get();
        return view('contacts.delete', compact('contacts', 'deleted'));
    }
}
