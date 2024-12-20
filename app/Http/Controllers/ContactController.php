<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
{
    // Murojaatlar ro'yxatini olish
    $contacts = Contact::latest()->paginate(9); // Yoki boshqa filtering qo'llash (masalan, order by)

    // Blade viewga contactsni uzatish
    return view('admin.contacts.index', compact('contacts'));
}


    public function store(Request $request)
{
    // Validatsiya qismi
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    // Yuborilgan ma'lumotlarni bazaga saqlash
    Contact::create($validated);

    // Muvaffaqiyatli xabar
    return redirect()->back()->with('success', 'Murojaatingiz yuborildi!');
}

public function markAsRead($id)
{
    $contact = Contact::findOrFail($id);
    $contact->is_read = true;
    $contact->save();

    return redirect()->route('contacts.index')->with('success', 'Murojaat o‘qildi deb belgilandi.');
}

public function destroy($id)
{
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return redirect()->route('contacts.index')->with('success', 'Murojaat o‘chirildi.');
}


}

