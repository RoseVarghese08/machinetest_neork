@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Employee Profile</h1>

        <!-- Display validation errors, if any -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employee-profiles.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
            </div>

            <div class="form-group">
                <label for="hobby">Hobby:</label>
                <select class="form-control" id="hobby" name="hobby_id" required>
                    
                    <option value="">Select a Hobby</option>
                    @foreach($hobbies as $hobby)
                        <option value="{{ $hobby->id }}">{{ $hobby->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="btn btn-primary position-absolute  end-0 m-3">Save</button>
            
        </form>
    </div>
@endsection
