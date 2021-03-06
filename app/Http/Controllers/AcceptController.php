<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'accepted']);
    }

    /**
     * Show the form for accept a privacy policy.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accept.create');
    }

    /**
     * Accept privacy policy.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['privacy' => 'accepted']);

        Auth::user()->accept();

        return redirect(route('info'));
    }
}
