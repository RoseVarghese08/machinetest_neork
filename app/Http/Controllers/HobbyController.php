<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Hobby; // Make sure to import your Hobby model

class HobbyController extends Controller
{
    public function index()
    {
        $hobbies = Hobby::all();
        return view('hobbies.index', compact('hobbies'));
    }

    public function create()
    {
        return view('hobbies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Hobby::create($request->all());

        return redirect()->route('hobbies.index')->with('success', 'Hobby created successfully');
    }

    public function edit($id)
    {
        $hobby = Hobby::find($id);
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hobby = Hobby::find($id);
        $hobby->update($request->all());

        return redirect()->route('hobbies.index')->with('success', 'Hobby updated successfully');
    }

    public function destroy($id)
    {
        $hobby = Hobby::find($id);
        $hobby->delete();

        return redirect()->route('hobbies.index')->with('success', 'Hobby deleted successfully');
    }
}
