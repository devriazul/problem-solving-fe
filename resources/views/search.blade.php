@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-md-offset-2">
            <div class="card shadow border-0 rounded p-4">
                <h1 class="pb-3 text-center text-success">Search Vaccination Status</h1>
                    <form action="/search" method="POST">
                        @csrf
                        <label class="pb-2">NID <span class="text-danger">*</span></label>
                        <input class="form-control mb-3" type="text" name="nid" placeholder="Enter NID" required>
                        <button class="btn btn-success px-4" type="submit">Search</button>
                        <a class="btn btn-danger px-4 ms-3" href="/">Back</a>
                    </form>

                    @if (isset($registration))
                        <div class="card p-4 m-5">
                            <h1 class="pb-3 text-center text-success">Results Found: </h1>
                            <p class="fw-bold">Name: {{ $registration->name }}</p>
                            <p class="fw-bold">NID: {{ $registration->nid }}</p>
                            <p class="fw-bold">Status: {{ $registration->vaccinated ? 'Vaccinated' : ($registration->scheduled_date ? 'Scheduled on ' . $registration->scheduled_date : 'Not Scheduled') }}</p>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
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
