<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeProfile;
use App\Models\Hobby;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\HobbyRequest;

class EmployeeProfileController extends Controller
{
    public function index()
    {
        $employeeProfiles = EmployeeProfile::all();
        return view('employee_profiles.index', compact('employeeProfiles'));
    }

    public function create()
    {
        $hobbies = Hobby::all(); // Fetch hobbies
        $categories = Category::all(); // Fetch categories
        return view('employee_profiles.create', compact('hobbies', 'categories'));
    }

    public function store(CategoryRequest $categoryRequest, HobbyRequest $hobbyRequest)
    {
        // Validate category request data
        $categoryRequest->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            // Add validation rules for category fields here.
        ]);

        // Validate hobby request data
        $hobbyRequest->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'hobby_id' => 'required|exists:hobbies,id',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for hobby fields here.
        ]);

        // Handle file upload if necessary for hobby.
        $fileName = null;
        if ($hobbyRequest->hasFile('profile_picture')) {
            $file = $hobbyRequest->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_pictures', $fileName); // Customize the storage path
        }

        // Create a new employee profile
        $employeeProfile = new EmployeeProfile;
        $employeeProfile->name = $categoryRequest->input('name');
        $employeeProfile->contact_number = $hobbyRequest->input('contact_number');
        $employeeProfile->hobby_id = $hobbyRequest->input('hobby_id');
        $employeeProfile->category_id = $categoryRequest->input('category_id');
        $employeeProfile->profile_picture = $fileName;

        $employeeProfile->save();

        return redirect()->route('employee-profiles.index')->with('success', 'Employee profile created successfully');
    }

    // public function edit($id)
    // {
    //     $employeeProfile = EmployeeProfile::find($id);
    //     $hobbies = Hobby::all(); // Fetch hobbies for the edit view
    //     return view('employee_profiles.edit', compact('employeeProfile', 'hobbies'));
    // }
    public function edit($id)
    {
        $employeeProfile = EmployeeProfile::find($id);
        $hobbies = Hobby::all(); // Fetch hobbies for the edit view
        $categories = Category::all(); // Fetch categories for the edit view
        return view('employee_profiles.edit', compact('employeeProfile', 'hobbies', 'categories'));
    }
    



    public function update(CategoryRequest $categoryRequest, HobbyRequest $hobbyRequest, $id)
    {
        // Validate category request data
        $categoryRequest->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            // Add validation rules for category fields here.
        ]);

        // Validate hobby request data
        $hobbyRequest->validate([
            'name' => 'required|string',
            'contact_number' => 'required|string',
            'hobby_id' => 'required|exists:hobbies,id',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation rules for hobby fields here.
        ]);

        // Handle file upload if necessary for hobby.
        $fileName = null;
        if ($hobbyRequest->hasFile('profile_picture')) {
            $file = $hobbyRequest->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_pictures', $fileName); // Customize the storage path
        }

        // Update the employee profile
        $employeeProfile = EmployeeProfile::find($id);
        $employeeProfile->name = $categoryRequest->input('name');
        $employeeProfile->contact_number = $hobbyRequest->input('contact_number');
        $employeeProfile->hobby_id = $hobbyRequest->input('hobby_id');
        $employeeProfile->category_id = $categoryRequest->input('category_id');
        $employeeProfile->profile_picture = $fileName;

        $employeeProfile->save();

        return redirect()->route('employee-profiles.index')->with('success', 'Employee profile updated successfully');
    }

    public function destroy($id)
    {
        $employeeProfile = EmployeeProfile::find($id);
        $employeeProfile->delete();

        return redirect()->route('employee-profiles.index')->with('success', 'Employee profile deleted successfully');
    }
}
