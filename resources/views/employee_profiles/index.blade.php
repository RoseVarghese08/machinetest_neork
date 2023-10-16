@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employee Profiles</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New button at the top left -->
    <a href="{{ route('employee-profiles.create') }}" class="btn btn-primary position-absolute top-0 end-0 m-3">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Hobby</th>
                <th>Category</th>
                <th>Profile Picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employeeProfiles as $profile)
            <tr>
                <td>{{ $profile->id }}</td>
                <td>{{ $profile->name }}</td>
                <td>{{ $profile->contact_number }}</td>
                <td>{{ $profile->hobby->name }}</td>
                <td>{{ $profile->category->name }}</td>
                <td>
                    @if ($profile->profile_picture)
                    <img src="{{ asset('storage/app/public' . $profile->profile_picture) }}" alt="Profile Picture" width="100">
                    @else
                    No Picture
                    @endif
                </td>



                <td>
                    <a href="{{ route('employee-profiles.edit', $profile->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('employee-profiles.destroy', $profile->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection