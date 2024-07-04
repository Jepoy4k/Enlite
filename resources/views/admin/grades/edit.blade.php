@extends('layout')

@section('content')
    <h1 class="my-4">Edit Grade for {{ $grade->CourseDescription }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('grades.update', $grade->GradeID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Midterm:</label>
            <input type="number" name="Midterm" class="form-control" value="{{ $grade->Midterm }}" step="0.01">
        </div>
        <div class="form-group">
            <label>Final:</label>
            <input type="number" name="Final" class="form-control" value="{{ $grade->Final }}" step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Update Grade</button>
    </form>
@endsection
