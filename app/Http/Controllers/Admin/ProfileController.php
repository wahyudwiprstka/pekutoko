<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    function index(): mixed
    {
        $profile = auth()->user();
        return view('admin.profile.index', compact('profile'));
    }

    // update profile
    function update(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|string|min:6|same:password',
        ], [
            'name.required' => 'Kolom nama diperlukan.',
            'name.string' => 'Kolom nama harus berupa teks.',
            'name.max' => 'Kolom nama tidak boleh lebih dari :max karakter.',
            'password.string' => 'Kolom password harus berupa teks.',
            'password.min' => 'Kolom password minimal :min karakter. ',
            'password_confirmation.string' => 'Kolom konfirmasi password harus berupa teks.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $user = auth()->user();
        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
        ]);
    }
}
