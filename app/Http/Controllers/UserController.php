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
        switch ($user->role_id)
        {
            case 1:
                $student = Student::where('user_id', $id)->first();
                return response()->json($student);
                break;
            case 2:
                $mentor = Mentors::where('user_id', $id)->first();
                return response()->json($mentor);
                break;
            case 3:
                $company = Company::where('user_id', $id)->first();
                return response()->json($company);
                break;
            default:
                return response()->json('aaaaaaaaaaaaaaa', 401);
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
