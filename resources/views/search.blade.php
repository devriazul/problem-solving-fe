@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-md-offset-2">
            <div class="card shadow border-0 rounded p-4">
                <h1 class="pb-3 text-center text-success">Search Vaccination Status</h1>

                <form action="{{ route('search.perform') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="pb-2">NID <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="nid" placeholder="Enter NID" required>
                    </div>
                    <button class="btn btn-success px-4" type="submit">Search</button>
                    <a class="btn btn-danger px-4 ms-3" href="/">Back</a>
                </form>

                {{-- Display success or error messages --}}
                @if (session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger mt-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Display previous search results if available --}}
                @if (isset($registration))
                <div class="card p-4 mt-4">
                    <h2 class="pb-3 text-success">Results Found:</h2>
                    <p class="fw-bold">Name: {{ $registration->name }}</p>
                    <p class="fw-bold">NID: {{ $registration->nid }}</p>
                    <p class="fw-bold">Status:
                        @if ($registration->vaccinated)
                            <span class="text-success">Vaccinated</span>
                        @elseif ($registration->scheduled_date)
                            <span class="text-warning">Scheduled on {{ $registration->scheduled_date }}</span>
                        @else
                            <span class="text-danger">Not Scheduled</span>
                        @endif
                    </p>
                </div>
                @elseif (isset($searchPerformed) && !$registration)
                <div class="alert alert-warning mt-4">
                    <h4 class="text-center">No Results Found</h4>
                    <p class="text-center">No vaccination record found for the provided NID. <br> If you are a new user, please register now.</p>
                    <div class="text-center mt-3">
                        <a class="btn btn-success btn-sm fw-semibold text-white px-3" href="/register">Register Now</a>
                    </div>
                </div>
                @endif


                {{-- Display validation error messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
