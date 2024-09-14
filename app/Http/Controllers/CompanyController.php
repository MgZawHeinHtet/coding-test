<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate ;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = request(['search','filter']);
        return view('company.index',[
            "companies" => Company::latest()->filter($requests)->paginate(3)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        
        if (Gate::forUser(auth()->user())->allows('create')) {
            $cleanData = $request->validated();
            $cleanData['logo'] = '/storage/' . $request->logo->store('/companies');
            Company::create($cleanData);
            return redirect('/dashboard/company')->with('create', 'Created Successfully 🎉');
        }else{
            return redirect('/dashboard/company')->withErrors(['errMsg'=>"Admin can only create Company!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit',["company"=>$company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        if (Gate::forUser(auth()->user())->allows('update')) {
            $cleanData = $request->validated();
            if ($request->logo) {
    
                if (File::exists($path = public_path($company->logo))) {
                    File::delete($path);
                }
                $company->logo = '/storage/' . $request->logo->store('/companies');
            }
            $company->name = $cleanData['name'];
            $company->email = $cleanData['email'];
            $company->website = $cleanData['website'];
            $company->update();
            return redirect('/dashboard/company')->with('edit', 'Updated Successfully 🎉');
        }else{
            return redirect('/dashboard/company')->withErrors(['errMsg'=>"Admin can only edit Company!"])->withInput();
        }

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        if (Gate::forUser(auth()->user())->allows('delete')) {
            $company->delete();
            return back()->with('delete', 'Delete Successfully! 🎆');
        }else{
            return redirect('/dashboard/company')->withErrors(['errMsg'=>"Admin can only delete Company!"])->withInput();
        }
        
    }
}
