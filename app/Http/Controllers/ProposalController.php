<?php

namespace App\Http\Controllers;

use App\Proposal;

class ProposalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        #return User::with('proposals')->get();
        return Proposal::all();
    }

    //
}
