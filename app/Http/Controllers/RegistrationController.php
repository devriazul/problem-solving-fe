<?php

namespace App\Http\Controllers;

use App\Models\UserRegistration;
use App\Models\VaccineCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VaccineScheduled;

class RegistrationController extends Controller
{
    // Show the registration form
    public function create()
    {
        // Retrieve all vaccine centers to display in the registration form
        $centers = VaccineCenter::all();
        return view('register', compact('centers'));
    }

    // Store the registration information
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'nid' => 'required|string|unique:user_registrations',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ]);

        // Find the selected vaccine center
        $center = VaccineCenter::find($request->vaccine_center_id);

        // Schedule the vaccination date
        $scheduled_date = $this->scheduleVaccination($center);

        // Create a new user registration record
        UserRegistration::create([
            'name' => $request->name,
            'email' => $request->email,
            'nid' => $request->nid,
            'vaccine_center_id' => $center->id,
            'scheduled_date' => $scheduled_date,
        ]);

        // Send email notification
        Mail::to($request->email)->send(new VaccineScheduled($scheduled_date));

        // Redirect back with success message
        return redirect('/')->with('success', 'Registration successful.');
    }

    // Search for user registrations based on input
    public function search(Request $request)
    {
        // Validate search input
        $request->validate([
            'query' => 'required|string',
        ]);

        // Perform the search
        $registrations = UserRegistration::where('name', 'like', '%' . $request->query . '%')
            ->orWhere('nid', 'like', '%' . $request->query . '%')
            ->get();

        // Return search results to a view
        return view('registration.search_results', compact('registrations'));
    }

    // Schedule vaccination date
    private function scheduleVaccination($center)
    {
        // Logic to schedule vaccination date
        // Here is an example that returns the next available weekday
        $nextDate = now()->nextWeekday(); // Adjust logic as necessary for your needs
        return $nextDate;
    }
}
