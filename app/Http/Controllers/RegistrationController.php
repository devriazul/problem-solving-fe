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

    public function index()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        // Validate NID input
        $request->validate([
            'nid' => 'required',
        ]);

        // Search for the registration based on NID
        $registration = UserRegistration::where('nid', $request->nid)->first();
        $searchPerformed = true; // Flag to indicate that search has been performed

        // If registration exists, fetch vaccine center information
        if ($registration) {
            // Use the vaccine_center_id to retrieve the vaccine center information
            $vaccineCenter = VaccineCenter::find($registration->vaccine_center_id);

            // Pass both registration and vaccine center data to the view
            return view('search', compact('registration', 'vaccineCenter', 'searchPerformed'));
        } else {
            return view('search', compact('registration', 'searchPerformed'))
                ->with('error', 'No registration found for the provided NID.');
        }
    }

    // Example function to schedule vaccination
    private function scheduleVaccination($center)
    {
        // Define the preferred days for vaccination
        $preferredDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];
        $today = now();

        // Loop through each day starting from today, and find the next available day
        for ($i = 0; $i < count($preferredDays); $i++) {
            $checkDate = now()->addDays($i); // Start with today and move to subsequent days
            // Check if the day is preferred and if the center has availability
            if (in_array($checkDate->format('l'), $preferredDays) && $this->isCenterAvailable($center, $checkDate)) {
                return $checkDate; // Return the next available day
            }
        }

        // If no available day is found, default to the next week's Sunday
        return now()->next('Sunday');
    }


    // Example function to check if the vaccine center is available on a specific date
    private function isCenterAvailable($center, $date)
    {
        // Get the total number of registrations for the given center on the given date
        $registrationsCount = UserRegistration::where('vaccine_center_id', $center->id)
                            ->whereDate('scheduled_date', $date->format('Y-m-d'))
                            ->count();

        // Check if the number of registrations is less than the daily limit
        return $registrationsCount < $center->daily_limit;
    }

}
