<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadilan Negri</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        /* Tambahkan CSS untuk memastikan sidebar tidak melampaui tinggi yang diinginkan */
        .sidebar {
            height: calc(100vh - 54px); /* Sesuaikan tinggi header jika diperlukan */       
        }

        @media (max-width: 640px) {
            .sidebar {
                position: fixed;
                z-index: 10;
                top: 54px; /* Sesuaikan dengan tinggi header */
                left: 0;
                bottom: 0;
                margin-top: 0rem;
            }

            .sidebar-hidden {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar-visible {
                transform: translateX(0);
                transition: transform 0.3s ease;
            }
            .header {
                position: fixed;
                width: 100%;
                top: 0;
                z-index: 100;
            }
            .main-content {
                position: fixed;
                z-index: 10;
                margin-top: 0px; /* Sesuaikan dengan tinggi header */
            }
        }       
    </style>
</head>
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true, isEditing: false, user: { nama: 'Arie', nip: '2104111010066', email: 'Arie@gmail.com', password: '******', jabatan: 'Kordinator Pengawas', divisi: '-'}, editUser: {}, showPopup: false, showUserForm: true }">
    <!-- Header -->
    <header class="w-full flex justify-between bg-white items-center p-2 drop-shadow-md relative z-50">
        <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen" class="text-black mr-4 ml-4">
                <svg x-show="sidebarOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 21L19 21C20.1046 21 21 20.1046 21 19L21 5C21 3.89543 20.1046 3 19 3L5 3C3.89543 3 3 3.89543 3 5L3 19C3 20.1046 3.89543 21 5 21Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 21L14 3" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                    
                <svg x-show="!sidebarOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 3V21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                    
            </button>
            
            <h1 class="text-base md:text-lg text-black font-bold">Nama Aplikasi</h1>
        </div>
        <div class="mx-2 sm:mx-4 flex items-center h-10">
            <p class="font-semibold text-black">Super Admin</p>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="{'w-60': sidebarOpen, 'w-16': !sidebarOpen, 'sidebar-visible': sidebarOpen, 'sidebar-hidden': !sidebarOpen}" class="bg-white text-black flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1">
                <ul>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="kelolaAkun" alt="Beranda" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                 
                            Kelola Akun
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="formatLaporan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 13H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 9H9H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                                
                            Format Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="tambahPengguna" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.5 11C10.7091 11 12.5 9.20914 12.5 7C12.5 4.79086 10.7091 3 8.5 3C6.29086 3 4.5 4.79086 4.5 7C4.5 9.20914 6.29086 11 8.5 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 8V14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23 11H17" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                           
                            Tambah Pengguna
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 mt-2">
                        <a href="kelolaAkun" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="formatLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 13H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 9H9H8" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="tambahPengguna" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Profile">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.5 11C10.7091 11 12.5 9.20914 12.5 7C12.5 4.79086 10.7091 3 8.5 3C6.29086 3 4.5 4.79086 4.5 7C4.5 9.20914 6.29086 11 8.5 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 8V14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23 11H17" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                </ul>
            </nav>
            <div class=" flex items-center justify-center p-4 " x-show="sidebarOpen">
                <a href="login" class="flex items-center justify-center text-[#FD3259] border-2 border-[#FD3259] rounded-[5px] font-medium w-3/5 hover:bg-red-200">
                    <svg class="mx-2" width="30" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 17L21 12L16 7" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 12H9" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Keluar
                </a>
            </div>
            <div class=" flex items-center justify-center p-4 " x-show="!sidebarOpen">
                <a href="login" class="w-full flex items-center justify-center border-2 border-[#FD3259] rounded-[5px] hover:bg-red-200">
                    <svg class="px-1" width="30" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16 17L21 12L16 7" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M21 12H9" stroke="#FD3259" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div :class="[sidebarOpen ? 'w-11/12' : 'w-full', 'bg-[#F2F3F9] ml-0 md:ml-28 lg:ml-16 xl:ml-60 flex-1 p-12 transition-all duration-300']">
            <div class="ml-auto flex items-center justify-end absolute top-20 right-14">
                <a href="kelolaAkun" class="flex w-fit items-center justify-center px-6 py-2 text-[11px] md:text-[12px] lg:text-[12px] bg-white rounded-[5px]">
                    <svg class="mr-2 w-3 md:w-3 lg:w-5 h-3 md:h-3 lg:h-5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 6H21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 12H21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M8 18H21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 6H3.01" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 12H3.01" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M3 18H3.01" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Kembali
                </a>
            </div>
            <form action="{{ route('users.editAkunProfil',  ['role' => 'Koordinator Pengawas']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <!-- Tempatkan x-data di elemen yang lebih tinggi -->
                <div x-data="{ sidebarOpen: true, isEditing: false, showPopup: false, showUserForm: true, originalImageUrl: '', previewImageUrl: '' }">
                    <template x-if="showUserForm">
                        <div class="flex flex-col lg:flex-row items-center justify-center bg-white h-fit w-80 md:w-80 lg:w-fit mr-44 md:mr-0 lg:mr-0 rounded-[5px] mt-5 lg:mt-20">
                            <div class="relative items-center p-5 md:p-2 mr-4 ml-0 md:ml-10 lg:ml-10">
                                <img id="profilePic" :src="previewImageUrl || originalImageUrl || '{{ $targetUser->profile_picture ? asset('storage/' . $targetUser->profile_picture) : asset('images/profile.png') }}'" alt="Profile Picture" class="w-40 md:w-52 lg:w-64 h-40 md:h-48 lg:h-52">
                                <button x-show="isEditing" type="button" class="absolute top-0 p-2" onclick="document.getElementById('profile_picture').click()">
                                    <img src="{{ asset('images/camera.png') }}" alt="Profile Image" class="w-6 h-6">
                                </button>
                                <input type="file" id="profile_picture" name="profile_picture" class="hidden" @change="previewImage">
                            </div>
                            <div class="items-center w-1/2 mt-6 mr-0 md:mr-20">
                                <!-- Nama -->
                                <div class="flex flex-row items-center mb-2">
                                    <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">Nama:</span>
                                    <template x-if="!isEditing">
                                        <span class="text-[14px] md:text-[12px] lg:[12px] font-normal text-black p-1">{{ $targetUser->name }}</span>
                                    </template>
                                    <template x-if="isEditing">
                                        <input id="editNama" name="name" value="{{ $targetUser->name }}" class="text-[14px] md:text-[12px] lg:[12px] font-semibold text-black border rounded p-1" />
                                    </template>
                                </div>
                                <!-- NIP -->
                                <template x-if="!isEditing">
                                    <div class="flex items-center mb-4 md:mb-2">
                                        <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">NIP:</span>
                                        <span class="text-[14px] md:text-[12px] lg:[12px] font-normal text-black p-1">{{ $targetUser->nip }}</span>
                                    </div>
                                </template>
                                <!-- Email -->
                                <div class="flex items-center mb-4 md:mb-2 w-full">
                                    <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">Email:</span>
                                    <template x-if="!isEditing">
                                        <span class="text-[14px] md:text-[12px] lg:[12px] font-normal text-black p-1">{{ $targetUser->email }}</span>
                                    </template>
                                    <template x-if="isEditing">
                                        <input id="editEmail" name="email" value="{{ $targetUser->email }}" class="text-[14px] md:text-[12px] lg:[12px] font-semibold text-black border rounded p-1" />
                                    </template>
                                </div>
                                <!-- Password -->
                                <div class="flex items-center mb-4 md:mb-2 ">
                                    <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">Password:</span>
                                    <template x-if="!isEditing">
                                        <span class="w-2/3 font-normal text-black p-1">******</span>
                                    </template>
                                    <template x-if="isEditing">
                                        <input type="password" id="editPassword" name="password" placeholder="Masukkan kata sandi baru" class="text-[14px] md:text-[12px] lg:[12px] font-semibold text-black border rounded p-1" />
                                    </template>
                                </div>
                                <!-- Jabatan -->
                                <template x-if="!isEditing">
                                    <div class="flex items-center mb-4 md:mb-2">
                                        <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">Jabatan:</span>
                                        <span class="text-[14px] md:text-[12px] lg:[12px] font-normal text-black p-1">{{ $targetUser->role }}</span>
                                    </div>
                                </template>
                                <!-- Bidang -->
                                <template x-if="!isEditing">
                                    <div class="flex items-center mb-4 md:mb-2">
                                        <span class="w-2/6 font-semibold text-[14px] md:text-[12px] lg:[12px] text-black">Bidang:</span>
                                        <span class="text-[14px] md:text-[12px] lg:[12px] font-normal text-black p-1">{{ $targetUser->bidang ?? '-'  }}</span>
                                    </div>
                                </template>
                                <!-- Tombol Edit dan Batal -->
                                <div class="flex item-center justify-start mt-5 mb-5">
                                    <template x-if="!isEditing">
                                        <button @click="isEditing = true; originalImageUrl = document.getElementById('profilePic').src;" class="flex bg-[#22805E] text-white text-[14px] md:text-[12px] font-semibold px-4 py-1 rounded-[5px] shadow-md hover:bg-green-800 mr-2">
                                            <svg class="mr-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.66699 3.8335H3.83366C3.39163 3.8335 2.96771 4.00909 2.65515 4.32165C2.34259 4.63421 2.16699 5.05814 2.16699 5.50016V17.1668C2.16699 17.6089 2.34259 18.0328 2.65515 18.3453C2.96771 18.6579 3.39163 18.8335 3.83366 18.8335H15.5003C15.9424 18.8335 16.3663 18.6579 16.6788 18.3453C16.9914 18.0328 17.167 17.6089 17.167 17.1668V11.3335" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M15.917 2.5832C16.2485 2.25168 16.6982 2.06543 17.167 2.06543C17.6358 2.06543 18.0855 2.25168 18.417 2.5832C18.7485 2.91472 18.9348 3.36436 18.9348 3.8332C18.9348 4.30204 18.7485 4.75168 18.417 5.0832L10.5003 12.9999L7.16699 13.8332L8.00033 10.4999L15.917 2.5832Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Ubah Profil
                                        </button>
                                    </template>
                                    <template x-if="isEditing">
                                        <div>
                                            <button type="submit" class="bg-[#22805E] text-white font-semibold px-8 py-1.5 shadow-md rounded-lg mr-4 mb-2">Simpan</button>
                                            <button @click="isEditing = false; document.getElementById('profilePic').src = originalImageUrl; resetFileInput();" class="border border-[#22805E] text-[#22805E] font-semibold px-8 py-1.5 shadow-md rounded-lg">Batal</button>
                                        </div>
                                    </template>
                                    <template x-if="!isEditing">
                                        <button @click.prevent="showPopup = true" class="flex bg-[#FD3259] text-white text-[14px] md:text-[12px] font-semibold px-4 py-1 rounded-[5px] shadow-md hover:bg-red-800">Hapus Akun</button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
            
                    <template x-if="showPopup">
                        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
                            <div class="bg-white px-0 py-3 md:px-6 md:py-6 rounded-lg shadow-lg">
                                <h2 class="text-base md:text-base lg:text-xl font-normal mx-8 mb-4">Apakah kamu yakin menghapus akun ini?</h2>
                                <div class="flex justify-center items-center space-x-4">
                                    <button @click="showPopup = false" class="bg-[#9B9B9B] text-white py-2 px-4 w-20 md:w-40 mr-4 rounded-md">Batal</button>
                                    <button @click="confirmDeletion" class="bg-[#FD3259] text-white py-2 px-4 w-20 md:w-40 rounded-md">Ya</button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </form>
            
            <!-- Form untuk penghapusan akun -->
            <form id="deleteUserForm" action="{{ route('users.destroy', ['id' => $targetUser->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>            

            <!-- Sertakan jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                // Fungsi untuk mereset input file
                function resetFileInput() {
                    const input = document.getElementById('profile_picture');
                    input.value = ''; // Reset input file
                }
                
                // Upload gambar profil
                $('#profile_picture').on('change', function() {
                    var formData = new FormData();
                    formData.append('profile_picture', this.files[0]);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('users.uploadProfilePicture', ['id' => $targetUser->id]) }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                // Update src gambar profil
                                $('#profilePic').attr('src', response.new_image_url);
                            }
                        },
                        error: function(response) {
                            alert('Gagal mengunggah gambar.');
                        }
                    });
                });

                // Preview gambar sebelum diupload
                function previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('profilePic').src = e.target.result;
                            document.querySelector('[x-data]').__x.$data.previewImageUrl = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                }

                document.getElementById('profile_picture').addEventListener('change', previewImage);

                $(document).ready(function() {
                    console.log($('#deleteUserForm').attr('action')); // Memeriksa URL action
                });

                function confirmDeletion() {
                    var redirectUrl = "{{ route('kelolaAkun') }}";
                    console.log("Redirecting to: ", redirectUrl);

                    $.ajax({
                        url: $('#deleteUserForm').attr('action'),
                        method: 'DELETE',
                        data: $('#deleteUserForm').serialize(),
                        success: function(response) {
                            // Setelah berhasil, sembunyikan pop-up dan tampilkan pesan sukses
                            document.querySelector('[x-data]').__x.$data.showPopup = false;
                            window.location.href = redirectUrl;  // Redirect ke halaman yang diinginkan
                        },
                        error: function(response) {
                            console.log(response); // Debugging jika perlu
                            alert('Gagal menghapus akun.');
                        }
                    });
                }
            </script>      
        </div> 
    </div>
</body>
</html>