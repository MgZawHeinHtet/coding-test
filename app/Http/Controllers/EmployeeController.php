<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate ;


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
       

        if (Gate::forUser(auth()->user())->allows('employee-create')) {
            $cleanData = $request->validated();

            $cleanData['profile'] = '/storage/' . $request->profile->store('/profiles');
            Employee::create($cleanData);
            return redirect('/dashboard/employee')->with('create', 'Created Successfully 🎉');
        }else{
            return redirect('/dashboard/employee')->withErrors(['errMsg'=>"Admin can only add employee!"])->withInput();
        }

        
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
        if (Gate::forUser(auth()->user())->allows('employee-update')) {
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
        }else{
            return redirect('/dashboard/employee')->withErrors(['errMsg'=>"Admin can only update Company!"])->withInput();
        }
        
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if (Gate::forUser(auth()->user())->allows('employee-delete')) {
            $employee->delete();
            return back()->with('delete', 'Delete Successfully! 🎆');
        }else{
            return redirect('/dashboard/employee')->withErrors(['errMsg'=>"Admin can only delete employee!"])->withInput();
        }
    }
}
