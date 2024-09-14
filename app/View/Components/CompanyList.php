<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use App\Models\Company;

use Illuminate\View\Component;

class CompanyList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $companies = Company::all();
        return view('components.company-list',['companies'=>$companies]);
    }
}
