<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:Super Admin,Pemberi Laporan,Pengawas,Koordinator Pengawas,Pimpinan',
            'bidang' => [
                Rule::requiredIf(function () use ($request) {
                    return !in_array($request->role, ['Koordinator Pengawas', 'Pimpinan']);
                }),
                Rule::in([
                    'Panmud Perdata',
                    'Panmud Pidana',
                    'Panmud Tipikor',
                    'Panmud PHI',
                    'Panmud Hukum',
                    'Sub Bag. Perencanaan, TI, dan Pelaporan',
                    'Sub Bag. Kepegawaian dan Ortala',
                    'Sub Bag. Umum dan Keuangan'
                ]),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = [
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        if ($request->has('bidang')) {
            $userData['bidang'] = $request->bidang;
        }

        User::create($userData);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan.');
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:Super Admin,Pemberi Laporan,Pengawas,Koordinator Pengawas,Pimpinan',
            'bidang' => [
                Rule::requiredIf(function () use ($request) {
                    return !in_array($request->role, ['Koordinator Pengawas', 'Pimpinan']);
                }),
                Rule::in([
                    'Panmud Perdata',
                    'Panmud Pidana',
                    'Panmud Tipikor',
                    'Panmud PHI',
                    'Panmud Hukum',
                    'Sub Bag. Perencanaan, TI, dan Pelaporan',
                    'Sub Bag. Kepegawaian dan Ortala',
                    'Sub Bag. Umum dan Keuangan'
                ]),
            ],
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->has('bidang')) {
            $userData['bidang'] = $request->bidang;
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

        public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->nama)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            switch ($user->role) {
                case 'Pemberi Laporan':
                    return redirect()->intended('/berandaPemberiLaporan');
                case 'Pengawas':
                    return redirect()->intended('/berandaPengawas');
                case 'Koordinator Pengawas':
                    return redirect()->intended('/berandaKoordinatorPengawas');
                case 'Pimpinan':
                    return redirect()->intended('/berandaPimpinan');
                default:
                    return redirect()->intended('/');
            }
        }

        return redirect('/login')->withErrors(['error' => 'Nama atau kata sandi salah']);
    }


}
