<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukm;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class UkmController extends Controller
{
    public function index(): mixed
    {
        $ukm = Ukm::all();
        return view('admin.ukm.index', compact('ukm'));
    }

    public function create(): mixed
    {
        return view('admin.ukm.create');
    }

    public function exportPDF($id)
    {
        $ukm = Ukm::find($id);

        // Buat PDF dengan menggunakan view
        $pdf = PDF::loadView('admin.pdf.index', compact('ukm'));

        // Download PDF
        return $pdf->download('umkm.pdf');
    }

    public function store(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'identity_number' => 'required',
                'ukm_name' => 'required',
                'ukm_address' => 'required',
                'wa_pic' => 'required',
                'ukm_email' => 'required',
            ], [
                'name.required' => 'Kolom nama diperlukan.',
                'identity_number.required' => 'Kolom nomor identitas diperlukan.',
                'ukm_name.required' => 'Kolom nama UKM diperlukan.',
                'ukm_address.required' => 'Kolom alamat UKM diperlukan.',
                'wa_pic.required' => 'Kolom WA PIC diperlukan.',
                'ukm_email.required' => 'Kolom email UKM diperlukan.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            DB::beginTransaction();

            $password = Str::random(6);
            $user = User::create([
                'name' => $request->name,
                'identity_number' => $request->identity_number,
                'role' => json_encode(['ukm']),
                'password' => bcrypt($password), // bcrypt(
                'temp_password' => $password
            ]);

            Ukm::create([
                'id_user' => $user->id,
                'ukm_name' => $request->ukm_name,
                'ukm_address' => $request->ukm_address,
                'wa_pic' => $request->wa_pic,
                'ukm_email' => $request->ukm_email,
                'ukm_status' => 1
            ]);

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($id): mixed
    {
        $ukm = Ukm::find($id);
        return view('admin.ukm.edit', compact('ukm'));
    }

    public function update(Request $request): mixed
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'identity_number' => 'required',
                'ukm_name' => 'required',
                'ukm_address' => 'required',
                'wa_pic' => 'required',
                'ukm_email' => 'required',
            ], [
                'name.required' => 'Kolom nama diperlukan.',
                'identity_number.required' => 'Kolom nomor identitas diperlukan.',
                'ukm_name.required' => 'Kolom nama UKM diperlukan.',
                'ukm_address.required' => 'Kolom alamat UKM diperlukan.',
                'wa_pic.required' => 'Kolom WA PIC diperlukan.',
                'ukm_email.required' => 'Kolom email UKM diperlukan.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            DB::beginTransaction();


            $user = User::find($request->id_user);
            $user->update([
                'name' => $request->name,
                'identity_number' => $request->identity_number,
            ]);

            $ukm = Ukm::find($request->id_ukm);
            $ukm->update([
                'ukm_name' => $request->ukm_name,
                'ukm_address' => $request->ukm_address,
                'wa_pic' => $request->wa_pic,
                'ukm_email' => $request->ukm_email,
                'ukm_status' => $request->ukm_status
            ]);

            DB::commit();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete($id): mixed
    {
        try {
            $ukm = Ukm::find($id);
            $ukm->delete();

            return response()->json([
                'code' => 200,
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
