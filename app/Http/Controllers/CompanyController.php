<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //show
    public function show($id)
    {
        $company = Company::find($id);
        return view('pages.company.show', compact('company'));
    }

    //edit
    public function edit(Company $company)
    {
        return view('pages.company.edit', compact('company'));
    }

    //update
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius_km' => 'required',
            'time_in' => 'required',
            'time_out' => 'required',
        ]);
        $company->update($request->all());
        return redirect()->route('companies.show', 1)->with('success', 'Company updated successfully');
    }
}
