<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        //
        $people = Users::whereExists(function ($query){
            $query->select(DB::raw(1))
                ->from('role_users')
                ->whereColumn('role_users.users_id','users.id');
        })->OrderBy('name')->with('roles')->get();
        return view('people.index',compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::OrderBy('name')->get();
        return view('people.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        Validate
        $request->validate([
            'name'=>['required','max:100'],
            'email'=>['required','max:100'],
            'password'=>['required']
        ]);

        $person = new Users;

        $person->name = $request->name;
        $person->email = $request->email;
        $person->password = Hash::make($request->password);
        $person->save();

        $person->roles()->sync($request->role_ids);

        return redirect(route('people'))->with('status', 'User Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Users $person)
    {
        //
        return redirect(route('people'))->with('status', 'Do not be a hacker');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $person)
    {
        //

        $roles = Role::OrderBy('name')->get();
        return view('people.edit',compact('person','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users $person)
    {
        //
        $request->validate([
            'name'=>['required','max:100'],
            'email'=>['required','max:100'],
        ]);
        //save changes to person
        $person->name = $request->name;
        $person->email = $request->email;
        if($request->password!='') {
            $person->password = Hash::make($request->password);
        }
        $person->save();



        //save the related languages in the pivot table
        $person->roles()->sync($request->role_ids);



        //redirect back to the list
        return redirect(route('people'))->with('status', 'User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $person)
    {
        //
        $person->delete();
        return redirect(route('people'))->with('status', 'Person Deleted');
    }
}
