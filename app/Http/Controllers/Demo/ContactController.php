<?php

namespace App\Http\Controllers\Demo;

use App\Models\Contact;

class ContactController extends BaseDemoController
{
    protected $model = Contact::class;

    protected $viewPath = 'contacts';

    protected $entityName = 'contact';

    protected function getRelations()
    {
        return ['company', 'deals', 'notes'];
    }

    public function index()
    {
        // Для контактов можно показать немного больше
        $contacts = Contact::with('company')
            ->latest()
            ->take(15)
            ->get();

        return view('demo.contacts.index', compact('contacts'));
    }
}
