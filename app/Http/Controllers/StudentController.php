<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Display a list of students
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $query = Student::query();
    
            // Apply search filter if provided
            if ($request->filled('search')) {
                $query->where('name', 'LIKE', '%' . $request->search . '%');
            }
    
            // Apply min_age filter if provided
            if ($request->filled('min_age') && is_numeric($request->min_age)) {
                $query->where('age', '>=', (int)$request->min_age);
            }
    
            // Apply max_age filter if provided
            if ($request->filled('max_age') && is_numeric($request->max_age)) {
                $query->where('age', '<=', (int)$request->max_age);
            }
    
            $students = $query->get();
    
            // Generate dynamic HTML for the table
            $output = '';
            if ($students->count() > 0) {
                foreach ($students as $student) {
                    $output .= '
                    <tr>
                        <td>' . $student->id . '</td>
                        <td>' . $student->name . '</td>
                        <td>' . $student->age . '</td>
                    </tr>';
                }
            } else {
                $output = '<tr><td colspan="3">No students found</td></tr>';
            }
    
            return response()->json($output);
        }
    
        return view('index');
    }
    

    // Show the form to create a new student
    public function create()
    {
        return view('create');
    }

    // Store a newly created student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age'  => 'required|integer|min:1|max:100',
        ]);

        Student::create([
            'name' => $request->name,
            'age'  => $request->age,
        ]);

        return redirect()->route('index')->with('success', 'Student added successfully!');
    }

    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
