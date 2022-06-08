<?php

namespace App\Http\Controllers;

use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactInformation::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'address' => 'required',
        ]);
        $contact = new ContactInformation();
        $contact->title = $request->title;
        $contact->address = $request->address;
        $contact->status = 'on';
        $contact->informations = $request->informations;
        $contact->save();
        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $contact = ContactInformation::find($id);
        if ($contact) {
            return response()->json($contact);
        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ContactInformation $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactInformation $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
        ]);
        return ContactInformation::where('id', $id)->update([
            'title' => $request->title,
            'address' => $request->address,
            'informations' => $request->informations,
            'status' => $request->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ContactInformation $contactInformation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        ContactInformation::destroy($id);
        return response()->json([
            'message' => 'Fotoğraf Silindi'
        ]);

    }
}
