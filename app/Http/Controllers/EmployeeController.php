<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = request(['search','filter']);
        return view('employee.index',[
            "employees" => Employee::with('company')->latest()->filter($requests)->paginate(3)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $cleanData = $request->validated();

        $cleanData['profile'] = '/storage/' . $request->profile->store('/profiles');
        Employee::create($cleanData);
        return redirect('/dashboard/employee')->with('create', 'Created Successfully 🎉');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit',["employee"=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        $cleanData = $request->validated();
        if ($request->profile) {

            if (File::exists($path = public_path($employee->profile))) {
                File::delete($path);
            }
            $employee->profile = '/storage/' . $request->profile->store('/profiles');
        }
        $employee->name = $cleanData['name'];
        $employee->email = $cleanData['email'];
        $employee->phone = $cleanData['phone'];
        $employee->company_id = $cleanData['company_id'];
      

        $employee->update();
        return redirect('/dashboard/employee')->with('edit', 'Updated Successfully 🎉');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('delete', 'Delete Successfully! 🎆');

    }
}
