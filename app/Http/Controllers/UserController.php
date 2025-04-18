<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Mentors;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function getInfo()
    {
        $id = Auth::user()->getAuthIdentifier();
        $user = User::where('id',$id)->first();
        if($user->role_id != 10)
        {
            switch ($user->role_id)
            {
                case 1:
                    return response()->json(Student::where('user_id', $id)->first());
                    break;
                case 2:
                    return response()->json(Mentors::where('user_id', $id)->first());
                    break;
                case 3:
                    return response()->json(Company::where('user_id', $id)->first());
                    break;
                default:
                    return response()->json('aaaaaaaaaaaaaaa', 401);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
