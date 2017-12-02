<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClient;
use App\Http\Requests\UpdateClient;

class ClientController extends Controller
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
        $clients = Client::all();

        return view('clients.index')->with('clients', $clients);
    }

    /**
     * Show the form for creating a new client.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \App\Http\Requests\StoreClient  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        Client::createFromRequest($request);

        return back()->with('status', 'The client was successfully created!');
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  \App\Client  $client
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $this->authorize('delete', $client);

        return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  \App\Http\Requests\UpdateClient  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClient $request, Client $client)
    {
        $client->updateFromRequest($request);

        return back()->with('status', 'The client was successfully updated!');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  \App\Client  $client
     * @throws \Illuminate\Auth\Access\AuthorizationException | \Exception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.create')->with('status', 'The client was successfully deleted!');
    }
}
