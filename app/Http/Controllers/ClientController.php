<?php

namespace App\Http\Controllers;

use App\Client;
use App\Queries\ClientsQuery;
use App\Filters\ClientFilters;
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
        $this->middleware(['auth', 'accept']);
    }

    /**
     * Show the application dashboard.
     *
     * @param  ClientFilters  $filters
     * @return \Illuminate\Http\Response
     */
    public function index(ClientFilters $filters)
    {
        $clients = app(ClientsQuery::class)($filters);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Client::class);

        return view('clients.create', ['client' => new Client]);
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \App\Http\Requests\StoreClient  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClient $request)
    {
        $client = Client::create($request->prepared());

        $client->syncTags($request->tags());

        return back()->with('status', 'The team was successfully created!');
    }

    /**
     * Show the form for editing the specified client.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Client $client)
    {
        $this->authorize('edit', $client);

        return view('clients.edit', compact('client'));
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
        $client->update($request->prepared());

        $client->syncTags($request->tags());

        return back()->with('status', 'The team was successfully updated!');
    }

    /**
     * Remove the specified client from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException | \Exception
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return redirect()->route('clients.create')->with('status', 'The team was successfully deleted!');
    }
}
