<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\Institute;


class AppController extends Controller
{
    public function init()
    {
        $user = User::where('email', 'admin@admin.ad')->first();

        if(!isset($user->id))
        {
            $user = new User();

            $user->name = 'admin';
            $user->role_id = 10;
            $user->email = 'admin@admin.ad';
            $user->password = bcrypt('admin1');

            $user->save();
        }
        $user = Auth::user();

        return response()->json(['user' => $user], 200);
    }

    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            return response()->json(Auth::user(), 200);
        }else{
            return response()->json(['error' => 'Логин или пароль введены некорректно'], 401);
        }
    }

    public function register_student(Request $request)
    {
        $student = new Student();
        $student->institute_id = $request->institute_id;
        $student->first_name = $request->first_name;
        $student->second_name = $request->second_name;
        $student->patronymic = $request->patronymic;
        $student->group = $request->group;

        $user = User::where('email', $request->email)->first();

        if(isset($user->id))
        {
            return response()->json(['error' => 'Пользователь с такой электроной почтой уже существует'], 401);
        }

        $user = new User();
        $name = $request->second_name . " " . $request->first_name;
        $user->name = $name;
        $user->role_id = 1;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        $user = User::where('email', $request->email)->first();

        $student->user_id = $user->id;

        $student->save();

        Auth::login($user);

        return response()->json(null, 200);
    }

    public function register_company(Request $request)
    {
        $company = new Company();

        $user = User::where('email', $request->email)->first();

        if(isset($user->id))
        {
            return response()->json(['error' => 'Пользователь с такой электроной почтой уже существует'], 401);
        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->password = bcrypt($request->password);

        $user->save();

        $company->name = $request->name;
        if($request->has_students == 'true') $company->has_students = true;
        else $company->has_students = false;
        $company->address = $request->address;
        $company->phone_number = $request->phone_number;
        $company->web_site = $request->web_site;
        $company->inn_kpp = $request->inn_kpp;

        $user = User::where('email', $request->email)->first();

        $company->user_id = $user->id;

        $company->save();

        Auth::login($user);

        return response()->json(null, 200);
    }

    public function logout()
    {
        Auth::logout();
    }

    public function companies()
    {
        $institutes = Company::all();
        return response()->json(['institutes' => $institutes]);
    }

    public function getRole()
    {
        $user = Auth::user();
        return response()->json(['user'=>$user], 200);
    }
}
