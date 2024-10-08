<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\StatusKPController;


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

    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $request->nama)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            session()->flash('showNotification', true);
            
            switch ($user->role) {
                case 'Pemberi Laporan':
                    return redirect()->intended('/berandaPemberiLaporan');
                case 'Pengawas':
                    return redirect()->intended('/berandaPengawas');
                case 'Koordinator Pengawas':
                    return redirect()->intended('/berandaKoordinatorPengawas');
                case 'Pimpinan':
                    return redirect()->intended('/berandaPimpinan');
                case 'Super Admin':
                    return redirect()->intended('/kelolaAkun');
                default:
                    return redirect()->intended('/');
            }
        }

        return redirect('/login')->withErrors(['error' => 'Nama atau kata sandi salah']);
    }

    public function showProfile($userId = null)
    {
        $user = Auth::user(); // Assuming the user is logged in

        // Jika user adalah Super Admin dan $userId diberikan, tampilkan akun pengguna lain
        if ($user->role === 'Super Admin' && $userId !== null) {
            $targetUser = User::findOrFail($userId); // Mengambil data pengguna berdasarkan ID
        
            // Menampilkan profil berdasarkan peran pengguna
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
                    return redirect('/super-admin')->withErrors('Role not found.');
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
    
    public function akunPimpinan()
    {
        $this->authorizeSuperAdmin(); // Cek apakah pengguna adalah Super Admin

        $targetUser = User::where('role', 'Pimpinan')->firstOrFail();
        return view('Super Admin.akunPimpinan', compact('targetUser'));
    }

    public function akunKoordinatorPengawas()
    {
        $this->authorizeSuperAdmin(); // Cek apakah pengguna adalah Super Admin

        $targetUser = User::where('role', 'Koordinator Pengawas')->firstOrFail();
        return view('Super Admin.akunKoordinatorPengawas', compact('targetUser'));
    }
    
    public function akunPemberiLaporan()
    {
        $this->authorizeSuperAdmin(); // Cek apakah pengguna adalah Super Admin

        // Ambil ID pengguna dari query string
        $userId = request()->query('user_id');

        if (!$userId) {
            return redirect('/')->withErrors('Tidak ada pengguna yang dipilih.');
        }

        // Ambil data pengguna berdasarkan ID dari query string
        $targetUser = User::findOrFail($userId);

        // Ambil bidang dari session
        $bidang = session('selected_bidang', null);

        // dd('User dengan bidang', [$bidang]);

        return view('Super Admin.akunPemberiLaporan', compact('targetUser', 'bidang'));
    }

    public function destroy($id)
    {
        $this->authorizeSuperAdmin();
        
        $user = User::findOrFail($id);

        // Hapus gambar profil jika ada
        if ($user->profile_picture) {
            Storage::delete('public/profile_pictures/' . $user->profile_picture);
        }

        // Simpan role pengguna yang akan dihapus sebelum dihapus
        $role = $user->role;

        // Ambil bidang dari session
        $bidang = session('selected_bidang', null);

        // dd('Before Deletion:', ['bidang' => $bidang, 'user' => $user, 'role' => $role]);

        if (!$bidang) {
            // Jika bidang tidak valid, redirect dengan error
            return redirect()->route('home')->withErrors('Bidang tidak valid.');
        }

        $user->delete();

        // dd('User deleted successfully', ['user_id' => $id]);

        // Redirect berdasarkan role pengguna
        if ($role == 'Pimpinan' || $role == 'Koordinator Pengawas') {
            \Log::info('Redirecting to kelolaAkun after deletion');
            return redirect()->route('kelolaAkun')->with('success', 'Akun berhasil dihapus.');
        } elseif ($role == 'Pemberi Laporan' || $role == 'Pengawas') {
            \Log::info('Redirecting to anggota after deletion');
             return redirect()->route('anggota', ['bidang' => $bidang])->with('success', 'Akun berhasil dihapus.');
        } else {
            // Redirect default jika role tidak sesuai dengan yang diharapkan
            return redirect()->route('home')->with('success', 'Akun berhasil dihapus.');
        }
    }

    public function akunPengawas()
    {
        $this->authorizeSuperAdmin(); // Cek apakah pengguna adalah Super Admin
    
        // Ambil ID pengguna dari query string
        $userId = request()->query('user_id');
    
        if (!$userId) {
            return redirect('/')->withErrors('Tidak ada pengguna yang dipilih.');
        }
    
        // Ambil data pengguna berdasarkan ID dari query string
        $targetUser = User::findOrFail($userId);
    
        // Ambil bidang dari session
        $bidang = session('selected_bidang', null);
    
        return view('Super Admin.akunPengawas', compact('targetUser', 'bidang'));
    }

    private function authorizeSuperAdmin()
    {
        if (Auth::user()->role !== 'Super Admin') {
            abort(403, 'Unauthorized action.');
        }
    }
    public function showAnggota()
    {
        // Daftar bidang yang valid
        $validBidangs = [
            'Panmud Perdata',
            'Panmud Pidana',
            'Panmud Tipikor',
            'Panmud PHI',
            'Panmud Hukum',
            'Sub Bag. Perencanaan, TI, dan Pelaporan',
            'Sub Bag. Kepegawaian dan Ortala',
            'Sub Bag. Umum dan Keuangan'
        ];
    
        // Ambil bidang dari query string
        $bidang = request()->query('bidang');
    
        // Jika bidang tidak valid, redirect ke halaman utama dengan error
        if ($bidang === null || !in_array($bidang, $validBidangs)) {
            return redirect('/')->withErrors('Bidang tidak valid.');
        }
    
        // Simpan bidang ke session
        session(['selected_bidang' => $bidang]);
    
        // Ambil pengguna berdasarkan bidang dan role
        $usersByBidang = User::where('bidang', $bidang)
            ->where(function($query) {
                $query->where('role', 'Pengawas')
                    ->orWhere('role', 'Pemberi Laporan');
            })
            ->get();
    
        // Cek peran pengguna yang sedang login
        $user = Auth::user();
    
        if ($user->role === 'Pimpinan') {
            // Jika pengguna adalah Pimpinan, arahkan ke tampilan Pimpinan.anggota
            return view('Pimpinan.anggota', compact('usersByBidang', 'bidang'));
        } elseif ($user->role === 'Koordinator Pengawas') {
            // Jika pengguna adalah Koordinator Pengawas, arahkan ke tampilan Koordinator Pengawas.anggota
            return view('Koordinator Pengawas.anggota', compact('usersByBidang', 'bidang'));
        }
    
        // Jika bukan Pimpinan atau Koordinator Pengawas, arahkan ke tampilan Super Admin.anggota
        return view('Super Admin.anggota', compact('usersByBidang', 'bidang'));
    }
    

    public function kelolaAkun()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
    
        // Ambil daftar bidang yang valid
        $validBidangs = [
            'Panmud Perdata',
            'Panmud Pidana',
            'Panmud Tipikor',
            'Panmud PHI',
            'Panmud Hukum',
            'Sub Bag. Perencanaan, TI, dan Pelaporan',
            'Sub Bag. Kepegawaian dan Ortala',
            'Sub Bag. Umum dan Keuangan'
        ];
    
        // Cek apakah yang login adalah Super Admin, Pimpinan, atau Koordinator Pengawas
        if ($user->role === 'Super Admin') {
            // Ambil target users berdasarkan beberapa role
            $targetUsers = User::whereIn('role', ['Pimpinan', 'Pemberi Laporan', 'Pengawas', 'Koordinator Pengawas'])->get();
    
            // Kelompokkan users berdasarkan bidang untuk 'Pemberi Laporan' dan 'Pengawas'
            $groupedUsers = $targetUsers->whereIn('role', ['Pemberi Laporan', 'Pengawas'])
                                        ->groupBy('bidang');
            $view = 'Super Admin.kelolaAkun';
        } elseif ($user->role === 'Pimpinan') {
            // Ambil target users khusus untuk Pimpinan
            $targetUsers = User::whereIn('role', ['Koordinator Pengawas', 'Pemberi Laporan', 'Pengawas'])->get();
    
            // Kelompokkan users berdasarkan bidang untuk 'Pemberi Laporan' dan 'Pengawas'
            $groupedUsers = $targetUsers->whereIn('role', ['Pemberi Laporan', 'Pengawas'])
                                        ->groupBy('bidang');
            $view = 'Pimpinan.beranda';
        } elseif ($user->role === 'Koordinator Pengawas') {
            // Ambil target users khusus untuk Koordinator Pengawas
            $targetUsers = User::whereIn('role', ['Pengawas', 'Pemberi Laporan'])->get();
    
            // Kelompokkan users berdasarkan bidang untuk 'Pemberi Laporan' dan 'Pengawas'
            $groupedUsers = $targetUsers->groupBy('bidang');
    
            // Memanggil getStatus dari StatusKPController
            $statusKPController = new StatusKPController();
            $statusData = $statusKPController->getStatus();
    
            // Ekstrak statusBulanan, currentMonth, dan currentYear dari hasil getStatus
            $statusBulanan = $statusData['statusBulanan'];
            $currentMonth = $statusData['currentMonth'];
            $currentYear = $statusData['currentYear'];
    
            // Mengirim variabel ke view Koordinator Pengawas.beranda
            return view('Koordinator Pengawas.beranda', compact('user', 'targetUsers', 'groupedUsers', 'validBidangs', 'statusBulanan', 'currentMonth', 'currentYear'));
        } else {
            // Jika bukan Super Admin, Pimpinan, atau Koordinator Pengawas, redirect dengan pesan error
            return redirect('/')->withErrors('Unauthorized access.');
        }
    
        // Mengirim variabel ke view sesuai dengan peran
        return view($view, compact('user', 'targetUsers', 'groupedUsers', 'validBidangs'));
    }
    
  
    

    public function editAkunProfil(Request $request, $role)
    {
        $this->authorizeSuperAdmin(); // Pastikan hanya Super Admin yang bisa mengakses

        // Temukan pengguna berdasarkan role
        $user = User::where('role', $role)->firstOrFail();

        // Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data pengguna
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $userData['profile_picture'] = $path;
        }

        $user->update($userData);

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}