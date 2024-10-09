<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        $request->validate(['nid' => 'required|string']);
        $registration = UserRegistration::where('nid', $request->nid)->first();

        // Logic for checking statuses
        return view('search', compact('registration'));
    }
}

