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
        return 'asd';
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function show(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactInformation $contactInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContactInformation  $contactInformation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactInformation $contactInformation)
    {
        //
    }
}