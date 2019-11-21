<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Account;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('backend.company.index')->withCompanies($companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = Account::all();
        return view('backend.company.create')->withAccounts($accounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $account = Account::findOrFail($request->account_id);
        
        $company = new Company;
        $company->uuid = Str::uuid();
        $company->name = $request->name;
        $company->description = $request->description;
        $company->account_id = $request->account_id;
        $company->user_id = $account->user_id;
        $company->type = $request->type;
        $company->status = $request->status;
        
        if ($company->save()) {
            return redirect()->route('company.index');
        } //else {
        //     Session::flash('danger', 'Sorry a problem occured while editing this event.');
        //     return redirect()->route('events.edit')->withInputs(); 
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('backend.company.show')->withCompany($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $accounts = Account::all();
        return view('backend.company.edit')->withCompany($company)->withAccounts($accounts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $account = Account::findOrFail($request->account_id);
        $company->uuid = Str::uuid();
        $company->name = $request->name;
        $company->description = $request->description;
        $company->account_id = $request->account_id;
        $company->user_id = $account->user_id;
        $company->type = $request->type;
        $company->status = $request->status;

          if ($company->save()) {
            return redirect()->route('company.index');
         } //else {
        //     Session::flash('danger', 'Sorry a problem occured while editing this event.');
        //     return redirect()->route('events.edit')->withInputs(); 
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company ->delete();
        return redirect()->route('company.index');
    }

    public function SendInvite()
    {
        $companies = Company::all();
        return view('backend.company.sendinvite')->withCompanies($companies);
    }
}
