<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('deleted', '<>', 1)->get();
        return response()->json(['users' => $users], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        return response()->json(['user' => $user], 200);
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
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'User has been updated successfully!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::where([
            ['id', '=', $id],
            ['deleted', '<>', 1]
        ])->first();

        $user->deleted = 1;
        $user->save();

        return response()->json(['message' => 'User has been deleted successfully!'], 200);
    }

    /**
     * Add user to company.
     * @param  \Illuminate\Http\Request  $request
     */
    public function addUserToCompany(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where([
            ['id', '=', $request->user_id],
            ['deleted', '<>', 1]
        ])->first();

        if (empty($user)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $company = Company::where([
            ['id', '=', $request->company_id],
            ['deleted', '<>', 1]
        ])->first();

        if (empty($company)) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $companyUser = CompanyUser::where([
            ['user_id', '=', $request->user_id],
            ['company_id', '=', $request->company_id],
        ])->first();

        if ($companyUser) {
            return response()->json(['error' => 'User in this Company already works'], 404);
        }

        $companyUser = new CompanyUser();
        $companyUser->user_id = $request->user_id;
        $companyUser->company_id = $request->company_id;
        $companyUser->save();

        return response()->json(['message' => 'User has been added to Company successfully!'], 200);
    }

    /**
     * Add user to company.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function updateUserCompany(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where([
            ['id', '=', $request->user_id],
            ['deleted', '<>', 1]
        ])->first();

        if (empty($user)) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $company = Company::where([
            ['id', '=', $request->company_id],
            ['deleted', '<>', 1]
        ])->first();

        if (empty($company)) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        // checking of existing User in other Company
        $companyUser = CompanyUser::where([
            ['user_id', '=', $request->user_id],
            ['company_id', '=', $request->company_id],
            ['id', '<>', $id],
        ])->first();

        if ($companyUser) {
            return response()->json(['error' => 'User in other Company already works'], 404);
        }

        $companyUser = CompanyUser::where('id', $id)->first();
        $companyUser->user_id = $request->user_id;
        $companyUser->company_id = $request->company_id;
        $companyUser->save();

        return response()->json(['message' => 'User has been updated at Company successfully!'], 200);
    }
}
