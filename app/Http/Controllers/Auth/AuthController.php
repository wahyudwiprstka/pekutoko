<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function index(): mixed
    {
        return view('admin._auth.login');
    }

    public function login(Request $request): mixed
    {
        try {
            if (Auth::attempt(['identity_number' => $request->identity_number, 'password' => $request->password])) {
                $user = Auth::user();

                $roles = json_decode($user->role);

                session([
                    'userRole' => $roles[0],
                    'name' => $user->name,
                    'isSuperadmin' => $user->is_superadmin
                ]);

                if ($roles[0] == 'admin' || $roles[0] == 'superadmin') {
                    return response()->json([
                        'code' => 200,
                        'status' => 'success',
                        'url' => 'admin/dashboard'
                    ]);
                } else if ($roles[0] == 'ukm') {
                    return response()->json([
                        'code' => 200,
                        'status' => 'success',
                        'url' => 'admin/product'
                    ]);
                } else {
                    return response()->json([
                        'code' => 400,
                        'status' => 'failed',
                        'message' => 'Role tidak ditemukan'
                    ]);
                }
            } else {
                return response()->json([
                    'code' => 400,
                    'status' => 'failed',
                    'message' => 'Nik atau Password Salah'
                ]);
            }
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function logout(): mixed
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
