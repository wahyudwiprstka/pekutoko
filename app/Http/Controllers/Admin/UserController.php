<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    function index(): mixed
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    function create(): mixed
    {
        return view('admin.users.create');
    }

    function store(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required',
            ], [
                'name.required' => 'Kolom nama diperlukan.',
                'password.required' => 'Kolom password diperlukan.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            User::create([
                'name' => $request->name,
                'password' => bcrypt($request->password),
                'role' => ["admin"],
            ]);

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    function edit($id): mixed
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    function update(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'status' => 'required',
            ], [
                'name.required' => 'Kolom nama diperlukan.',
                'status.required' => 'Kolom status diperlukan.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->status = $request->status;
            $user->save();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
