@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-md-8 col-md-offset-2">
                <div class="card shadow border-0 rounded p-4">
                    <h1 class="pb-3 text-center text-success">Register for Vaccine</h1>
                    <form class="" action="/register" method="POST">
                        @csrf
                        <label class="pb-2">Full Name <span class="text-danger">*</span></label>
                        <input class="form-control mb-3" type="text" name="name" placeholder="Type your name" required>
                        <label class="pb-2">Email <span class="text-danger">*</span></label>
                        <input class="form-control mb-3" type="email" name="email" placeholder="Type your email" required>
                        <label class="pb-2">NID <span class="text-danger">*</span></label>
                        <input class="form-control mb-3" type="text" name="nid" placeholder="Type your NID" required>
                        <label class="pb-2">Vaccine Center <span class="text-danger">*</span></label>
                        <select class="form-control mb-3" name="vaccine_center_id">
                            @foreach ($centers as $center)
                                <option value="{{ $center->id }}">{{ $center->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-success px-4" type="submit">Register</button>
                        <a class="btn btn-danger px-4 ms-2" href="/search">Check Status</a>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
