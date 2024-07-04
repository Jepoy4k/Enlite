@extends('layout')

@section('content')
    <h1 class="my-4">Add New Student</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="FirstName" class="form-control" value="{{ old('FirstName') }}">
        </div>
        <div class="form-group">
            <label>Middle Name:</label>
            <input type="text" name="MiddleName" class="form-control" value="{{ old('MiddleName') }}">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="LastName" class="form-control" value="{{ old('LastName') }}">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="Email" class="form-control" value="{{ old('Email') }}">
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="Address" class="form-control" value="{{ old('Address') }}">
        </div>
        <div class="form-group">
            <label>Birthdate:</label>
            <input type="date" name="Birthdate" class="form-control" value="{{ old('Birthdate') }}">
        </div>
        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" name="ContactNumber" class="form-control" value="{{ old('ContactNumber') }}">
        </div>
        <div class="form-group">
            <label>Enrollment Status:</label>
            <input type="text" name="EnrollmentStatus" class="form-control" value="{{ old('EnrollmentStatus') }}">
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection
