<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::where('deleted', '<>', 1)->get();
        return response()->json(['companies' => $companies], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
        ]);

        $company = new Company();
        $company->fill($request->all());
        $company->save();

        return response()->json(['message'=>'Company has been created successfully!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        return response()->json(['company' => $company], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:100'],
        ]);

        $company = Company::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        $company->fill($request->all());
        $company->save();

        return response()->json(['message' => 'Company has been updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $company = Company::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        $company->deleted = 1;
        $company->save();

        return response()->json(['message' => 'Company has been deleted successfully!'], 200);
    }
}
