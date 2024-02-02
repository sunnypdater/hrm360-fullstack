<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Employee;

class UserController extends Controller
{
    public function index()
    {
        $result = DB::table('users')->join('employees', 'employees.user_id', '=', 'users.id')->get();
        return response()->json([
            'data' => $result
        ], 200);
    }
}
