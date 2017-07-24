<?php

namespace App\Http\Controllers;

use App\Office;
use App\Http\Requests\StoreOffice;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();

        return view('offices.index')->with('offices', $offices);
    }

    /**
     * Show the form for creating a new office.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offices.create');
    }

    /**
     * Store a newly created office in storage.
     *
     * @param  \App\Http\Requests\StoreOffice  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffice $request)
    {
        Office::create($request->all());

        return back()->with('status', 'The office was successfully created!');
    }

    /**
     * Show the form for editing the specified office.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return view('offices.edit')->with('office', $office);
    }

    /**
     * Update the specified office in storage.
     *
     * @param  \App\Http\Requests\StoreOffice  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOffice $request, Office $office)
    {
        $office->update($request->all());

        return back()->with('status', 'The office was successfully updated!');
    }

    /**
     * Remove the specified office from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('offices.create')->with('status', 'The office was successfully deleted!');
    }
}
