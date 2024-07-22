<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadilan Negri</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true, isEditing: false, user: { nama: 'Arie', nip: '2104111010066', email: 'Arie@gmail.com', password: '******' }, editUser: {} }">
    <!-- Header -->
    <header class="w-full flex justify-between bg-[#006634] items-center p-2 drop-shadow-2xl">
        <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen" class="text-black mr-4 ml-4">
                <svg x-show="sidebarOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 21L19 21C20.1046 21 21 20.1046 21 19L21 5C21 3.89543 20.1046 3 19 3L5 3C3.89543 3 3 3.89543 3 5L3 19C3 20.1046 3.89543 21 5 21Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 21L14 3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                    
                <svg x-show="!sidebarOpen" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 3V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                    
            </button>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 mr-4">
            <h1 class="text-lg text-white font-bold">Nama Aplikasi</h1>
        </div>
        <div class="flex items-center">
            <div class="mx-8 flex items-center">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div class="ml-4">
                    <p class="font-semibold text-[#FFFFFF]">Arie</p>
                    <p class="text-sm text-[#F3F3F3]">Pemberi Laporan</p>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-93vh">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-60' : 'w-16'" class="bg-[#006634] text-white flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1 mt-4">
                <ul>
                    <li class="p-2 mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="beranda" alt="Beranda" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                                
                            Beranda
                        </a>
                    </li>
                    <li class="p-2 hover:bg-green-600 mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="#" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Unggah Laporan
                        </a>
                    </li>
                    <li class="p-2 hover:bg-green-600 mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="#" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-2 bg-[#F3D910] mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="profil" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4">
                        <a href="beranda" x-show="!sidebarOpen" title="Beranda">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="#" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="#" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="#" class="flex items-center rounded p-1 bg-[#F3D910]" x-show="!sidebarOpen" title="Profile">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> 
                        </a>
                    </li>
                </ul>
            </nav>
            <div class=" flex items-center justify-center p-4 border-t-2" x-show="sidebarOpen">
                <a href="login" class="flex items-center justify-center text-white font-medium hover:bg-green-600 w-3/5 border rounded-lg">
                    <img src="{{ asset('images/keluar.png') }}" alt="Logo" class="h-12 w-10 mr-4">
                    Keluar
                </a>
            </div>
            <div class=" flex items-center justify-center p-4 border-t-2" x-show="!sidebarOpen">
                <a href="login" class="w-full flex items-center justify-center mt-2 mb-2 border rounded hover:bg-green-600">
                    <img src="{{ asset('images/keluar.png') }}" alt="Logo" class="h-8 w-8">
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="flex items-center justify-center transition-all duration-300">
            <div class="flex items-center justify-center bg-white h-4/6 w-8/12 rounded-xl shadow-lg fixed">
                <div class="relative p-8 mr-16">
                    <img :src="editUser.photo || '{{ asset('images/profile.png') }}'" alt="Profile Picture" class="w-80 h-72">
                    <button x-show="isEditing" @click="$refs.fileInput.click()" class="absolute top-10 p-2">
                        <img src="{{ asset('images/camera.png') }}"  alt="Profile Image" class="w-6 h-6">
                    </button>
                    <input type="file" x-ref="fileInput" class="hidden" @change="previewImage">
                </div>
                <div class="w-1/2">
                    <div class="flex items-center mb-4">
                        <span class="w-1/3 font-semibold text-black">Nama:</span>
                        <template x-if="!isEditing">
                            <span x-text="user.nama" class="w-2/3 font-semibold text-black p-1"></span>
                        </template>
                        <template x-if="isEditing">
                            <input x-model="editUser.nama" class="w-2/3 font-semibold text-black border rounded p-1" />
                        </template>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="w-1/3 font-semibold text-black">NIP:</span>
                        <template x-if="!isEditing">
                            <span x-text="user.nip" class="w-2/3 font-semibold text-black p-1"></span>
                        </template>
                        <template x-if="isEditing">
                            <input x-model="editUser.nip" class="w-2/3 font-semibold text-black border  rounded p-1" />
                        </template>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="w-1/3 font-semibold text-black">Email:</span>
                        <template x-if="!isEditing">
                            <span x-text="user.email" class="w-2/3 font-semibold text-black p-1"></span>
                        </template>
                        <template x-if="isEditing">
                            <input x-model="editUser.email" class="w-2/3 font-semibold text-black border  rounded p-1" />
                        </template>
                    </div>
                    <div class="flex items-center mb-4">
                        <span class="w-1/3 font-semibold text-black">Password:</span>
                        <template x-if="!isEditing">
                            <span x-text="user.password" class="w-2/3 font-semibold  text-black p-1"></span>
                        </template>
                        <template x-if="isEditing">
                            <input type="password" x-model="editUser.password" class="w-2/3 font-semibold text-black border rounded p-1" />
                        </template>
                    </div>
                    <div class="flex item-center justify-start mt-16">
                        <template x-if="!isEditing">
                            <button @click="isEditing = true; editUser = { ...user }" class="flex bg-[#006634] text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-green-800">
                                <svg class="mr-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.66699 3.8335H3.83366C3.39163 3.8335 2.96771 4.00909 2.65515 4.32165C2.34259 4.63421 2.16699 5.05814 2.16699 5.50016V17.1668C2.16699 17.6089 2.34259 18.0328 2.65515 18.3453C2.96771 18.6579 3.39163 18.8335 3.83366 18.8335H15.5003C15.9424 18.8335 16.3663 18.6579 16.6788 18.3453C16.9914 18.0328 17.167 17.6089 17.167 17.1668V11.3335" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.917 2.5832C16.2485 2.25168 16.6982 2.06543 17.167 2.06543C17.6358 2.06543 18.0855 2.25168 18.417 2.5832C18.7485 2.91472 18.9348 3.36436 18.9348 3.8332C18.9348 4.30204 18.7485 4.75168 18.417 5.0832L10.5003 12.9999L7.16699 13.8332L8.00033 10.4999L15.917 2.5832Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Ubah Profil
                            </button>
                        </template>
                        <template x-if="isEditing">
                            <div>
                                <button @click="isEditing = false; user = { ...editUser }" class="bg-[#006634] text-white font-semibold px-8 py-1.5 shadow-md rounded-lg mr-4">Simpan</button>
                                <button @click="isEditing = false; editUser = { ...user }" class="border border-[#006634] text-[#006634] font-semibold px-8 py-1.5 shadow-md rounded-lg">Batal</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>           
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = (e) => {
                this.editUser.photo = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>

