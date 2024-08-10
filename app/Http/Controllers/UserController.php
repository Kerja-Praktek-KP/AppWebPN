<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                'nullable', // Set bidang to nullable
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
            'bidang' => $request->bidang, // Set bidang value directly
        ];

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

    public function showProfile($userId = null)
    {
        $user = Auth::user(); // Assuming the user is logged in

        if ($user->role === 'Super Admin' && $userId) {
            $targetUser = User::find($userId);

            if (!$targetUser) {
                return redirect('/')->withErrors('User not found.');
            }

            switch ($targetUser->role) {
                case 'Pemberi Laporan':
                    return view('Super Admin.akunPemberiLaporan', compact('targetUser'));
                case 'Pengawas':
                    return view('Super Admin.akunPengawas', compact('targetUser'));
                case 'Koordinator Pengawas':
                    return view('Super Admin.akunKoordinatorPengawas', compact('targetUser'));
                case 'Pimpinan':
                    return view('Super Admin.akunPimpinan', compact('targetUser'));
                default:
                    return redirect('/')->withErrors('Role not found.');
            }
        }

        // Handle the profile view for non-Super Admin users
        switch ($user->role) {
            case 'Pemberi Laporan':
                return view('Pemberi Laporan.profilPemberiLaporan', compact('user'));
            case 'Pengawas':
                return view('Pengawas.profil', compact('user'));
            case 'Koordinator Pengawas':
                return view('Koordinator Pengawas.profil', compact('user'));
            case 'Pimpinan':
                return view('Pimpinan.profil', compact('user'));
            default:
                return redirect('/')->withErrors('Role not found.');
        }
    }

    public function updateProfil(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                $oldFilePath = 'public/' . $user->profile_picture;
    
                // Pastikan file lama benar-benar ada sebelum menghapusnya
                if (Storage::disk('public')->exists($user->profile_picture)) {
                    Storage::disk('public')->delete($user->profile_picture);
                } 
            }
    

            // Mendapatkan nama asli file
            $originalName = $request->file('profile_picture')->getClientOriginalName();

            // Menyimpan file baru dengan nama aslinya ke storage
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $originalName, 'public');
            $userData['profile_picture'] = $path;
        }
        
        // Update user with the new data
        $user->update($userData);

        return redirect()->route('users.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user = auth()->user(); // Mendapatkan user yang sedang login
    
        if ($request->hasFile('profile_picture')) {
            // Periksa apakah user sudah memiliki gambar profil yang tersimpan
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
    
            // Simpan file baru
            $originalName = $request->file('profile_picture')->getClientOriginalName();
            $path = $request->file('profile_picture')->storeAs('profile_pictures', $originalName, 'public');
    
            // Perbarui database
            $user->profile_picture = $path;
            $user->save();
            
            // Dapatkan URL gambar baru
            $newImageUrl = asset('storage/' . $path);
        } else {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan.']);
        }
    
        return response()->json(['success' => true, 'new_image_url' => $newImageUrl]);
    }    

}
