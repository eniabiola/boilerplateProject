<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use App\Models\Account;
use App\Models\SendInvite;
use App\Mail\SendUserInvite;
use App\Mail\SendUserInviteConfirmation;
use App\Mail\SendCompanyInviteConfirmation;
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
         }
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

    public function SentInvite(Request $request)
    {

        $sendinvite = new SendInvite;
        $sendinvite->name = $request->name;
        $sendinvite->email = $request->email;
        $sendinvite->company_id = $request->Company;
        $sendinvite->slug = md5(microtime());
        $company = Company::findOrFail($request->Company);
        if ($sendinvite->save()) 
        {
            $url = url("company/receivedinvite/".$sendinvite->name."/".$sendinvite->slug);

            $gonder = array( 'Company'=>$company->name,
                'url'=>$url,
                'name'=>$request->name,
                'email' => $request->email
            );
           \Mail::to($request)->send(new SendUserInvite($gonder));  
           return  redirect()->route('company.index');
        }
    }

    public function redirectPath()
    {
        return route(home_route());
    }

    public function ReceivedInvite($name, $slug)
    {
        $sendInvite = SendInvite::where([
        ['name', '=', $name],
        ['slug', '=', $slug]
        ])
        ->first();
        if ($sendInvite == null) {
            abort(404);
        } else {
            return view('backend.company.registeruser');
        }
    }

    public function RegisteredUser(RegisterRequest $request)
    {
        $newUser = New User;
        $newUser->first_name = $request->first_name; 
        $newUser->last_name = $request->last_name;
        $newUser->uuid = Str::uuid();
        $newUser->email =  $request ->email;
        $newUser->password = $request->password;
        $newUser->confirmation_code = md5(uniqid(mt_rand()));
        $newUser->confirmed = true;
        $newUser->active = true;

         if ($newUser->save()) {
                // Add the default site role to the new user
                $newUser->assignRole(config('access.users.default_role'));   
                $sentinvite = SendInvite::where('email', '=', $request->email);
                $gonder = array( 
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email'=>$request->email,
                );
               \Mail::to($request)->send(new SendCompanyInviteConfirmation($gonder));
               \Mail::to($request)->send(new SendUserInviteConfirmation);
                auth()->login($newUser);

                event(new UserRegistered($newUser));

                return redirect($this->redirectPath());

            }
    }
}
