@extends('layouts.app')

@section('content')
    <h1>Student Details</h1>
    <p>UserID: {{ $student->UserID }}</p>
    <p>FirstName: {{ $student->FirstName }}</p>
    <p>MiddleName: {{ $student->MiddleName }}</p>
    <p>LastName: {{ $student->LastName }}</p>
    <p>Email: {{ $student->Email }}</p>
    <p>Address: {{ $student->Address }}</p>
    <p>Birthdate: {{ $student->Birthdate }}</p>
    <p>ContactNumber: {{ $student->ContactNumber }}</p>
    <p>EnrollmentStatus: {{ $student->EnrollmentStatus }}</p>
    <a href="{{ route('students.edit', $student->StudentID) }}">Edit</a>
@endsection
