@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Employee Profile</h2>
        <form method="POST" action="{{ route('employee-profiles.update', ['employee_profile' => $employeeProfile->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ $employeeProfile->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" value="{{ $employeeProfile->contact_number }}" class="form-control" required>
            </div>

            <div class="form-group">
    <label for="hobby_id">Hobby</label>
    <select name="hobby_id" id="hobby_id" class="form-control">
        @foreach ($hobbies as $hobby)
            <option value="{{ $hobby->id }}" {{ $hobby->id == $employeeProfile->hobby_id ? 'selected' : '' }}>
                {{ $hobby->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="category_id">Category</label>
    <select name="category_id" id="category_id" class="form-control">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $category->id == $employeeProfile->category_id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


            <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
@endsection
