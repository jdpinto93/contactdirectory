<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Country;
use App\Models\Organization;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Inertia\Inertia;

use function Laravel\Prompts\select;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = Request::input('search');
        $perPage = Request::input('perPage', 20);

        $contacts = Contact::filterBuilder($search, $perPage);

        return Inertia::render('Contacts/Index', [
            'filters' => Request::all('search'),
            'contacts' => $contacts,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = DB::table('organizations')
            ->select('id', 'name as title')
            ->get();
        $countries = DB::table('countries')
            ->select('id', 'name as title')
            ->get();

        return Inertia::render('Contacts/Create', compact('organizations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        Contact::create($data);

        return redirect()->route('contacts.edit')->with('success', 'Contact created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {

        $organizations = DB::table('organizations')
            ->select('id', 'name as title')
            ->get();

        $countries = DB::table('countries')
            ->select('id', 'name as title')
            ->get();

        return Inertia::render('Contacts/Edit', [
            'contact' => $contact,
            'organizations' => $organizations,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();

        $contact->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
