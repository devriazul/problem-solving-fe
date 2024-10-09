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
        // Validate incoming request data
        $request->validate([
            'nid' => 'required|string',
        ]);

        // Search for the registration
        $registration = UserRegistration::where('nid', $request->nid)->first();
        $searchPerformed = true; // Set this flag to true regardless of whether the user was found

        // Return the search view with the registration data
        return view('search', compact('registration', 'searchPerformed'))
            ->with('success', $registration ? 'Results found for NID: ' . $registration->nid : 'No registration found for the provided NID.');
    }




    // Schedule vaccination date
    private function scheduleVaccination($center)
    {
        // Define the desired scheduling logic
        $preferredDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday']; // Days available for vaccination
        $today = now();

        // Check the availability of the vaccine center and adjust scheduling accordingly
        if (in_array($today->format('l'), $preferredDays)) {
            // If today is a preferred day, schedule for today
            return $today;
        } else {
            // Find the next available weekday
            foreach ($preferredDays as $day) {
                $nextDate = now()->next($day);
                if ($this->isCenterAvailable($center, $nextDate)) {
                    return $nextDate; // Return the next available date based on the center's availability
                }
            }
        }

        // If no preferred day is found this week, schedule for next week's Sunday
        return now()->next('Sunday');
    }

    // Example function to check if the vaccine center is available on a specific date
    private function isCenterAvailable($center, $date)
    {
        return true; // Assuming the center is available; adjust as necessary
    }
}
