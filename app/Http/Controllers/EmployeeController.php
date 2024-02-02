<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->get();
        return response()->json([
            'data' => $result
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $createRequestData = $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'gender'=>'required|string',
            'level'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'role'=>'required|string',
            'position'=>'required|string',
            'department'=>'required|string',
        ]);

        // dd($createRequestData);

        $user = User::create([
            'name' => $createRequestData['firstname'] . ' ' . $createRequestData['lastname'],
            'email' => $createRequestData['email'],
            'password' => Hash::make($this->randomPassword()),
        ]);

        $employee = Employee::create([
            'user_id' => $user->id,
            'firstname' => $createRequestData['firstname'],
            'lastname' => $createRequestData['lastname'],
            'gender' => $createRequestData['gender'],
            'level' => $createRequestData['level'],
            'position' => $createRequestData['position'],
            'role' => $createRequestData['role'],
            'department' => $createRequestData['department'],
        ]);

        // $employee = Employee::create($request->all());
        // return response()->json($request);
        return response()->json($employee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Employee $employee)
    {
        return response()->json($employee);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee->update($request->all());
        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json(null, 204);
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
