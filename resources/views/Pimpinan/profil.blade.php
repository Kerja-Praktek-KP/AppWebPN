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
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true, isEditing: false, user: { nama: 'Arie', nip: '2104111010066', email: 'Arie@gmail.com', password: '******', jabatan: 'Pimpinan', bidang: '-' }, editUser: {nama: '', nip: '', email: '', password: ''} }">
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
        <div class="flex items-center">
            <div class="mx-2 sm:mx-4 flex items-center">
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div class="-ml-0 sm:ml-4">
                    <p class="text-[15px] font-semibold text-black sr-only sm:not-sr-only">{{ Auth::user()->name }}</p>
                    <p class="md:text-[15px] text-[#686767] sr-only sm:not-sr-only">Pimpinan</p>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="{'w-60': sidebarOpen, 'w-16': !sidebarOpen, 'sidebar-visible': sidebarOpen, 'sidebar-hidden': !sidebarOpen}" class="bg-white text-black flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1">
                <ul>
                    <li class="hover:bg-gray-200 p-3 pl-8 mx-full my-4" x-show="sidebarOpen">
                        <a href="berandaPimpinan" alt="Beranda" class="flex items-center  font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Beranda
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="unggahLaporanPimpinan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Unggah Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="riwayatLaporanPimpinan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="profilPimpinan" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 mt-2">
                        <a href="berandaPimpinan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="unggahLaporanPimpinan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riwayatLaporanPimpinan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="profilPimpinan" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Profile">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
        <div :class="[sidebarOpen ? 'w-11/12' : 'w-full', 'p-4 bg-[#F2F3F9] flex-1 transition-all duration-300 overflow-y-auto lg:overflow-y-hidden']">
            <div class="flex justify-center items-center h-screen bg-[#F2F3F9] my-96 md:my-60 lg:my-0">
                <div class="mb-16 flex flex-col lg:flex-row w-full justify-center max-w-5xl">
                    <!-- Profile Info -->
                    <div class="w-full lg:w-4/6 p-4 mr-4 rounded-xl bg-white">
                        <div class="w-48 h-52 mx-auto">
                            <img :src="editUser.photo || '{{ asset('images/profile.png') }}'" alt="Profile Picture" class="w-full h-full object-cover rounded-md">
                        </div>                        
                        <div class="flex flex-col md:flex-row">
                            <div class="mt-2 mr-8 w-full md:w-3/5">
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2 ">Nama:</span>
                                    <template x-if="!isEditing">
                                        <input x-model="user.nama" class="w-full font-normal text-black bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                                
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2">Email:</span>
                                    <template x-if="!isEditing">
                                        <input x-model="user.email" class="w-full font-normal text-black  bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2">Kata Sandi:</span>
                                    <template x-if="!isEditing">
                                        <input type="password" x-model="user.password" class="w-full font-normal text-black  bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                            </div>
                            <div class="mt-2 w-full">
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2">NIP:</span>
                                    <template x-if="!isEditing">
                                        <input x-model="user.nip" class="w-full font-normal text-black  bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2">Jabatan:</span>
                                    <template x-if="!isEditing">
                                        <input x-model="user.jabatan" class="w-full font-normal text-black  bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                                <div class="flex flex-col items-start mb-4">
                                    <span class="font-normal text-black mb-2">Bidang:</span>
                                    <template x-if="!isEditing">
                                        <input  x-model="user.bidang" class="w-full font-normal text-black  bg-[#E9F3EF] rounded p-2" disabled />
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- Edit Profile Info -->
                    <div class="w-full lg:w-4/12 p-4 bg-white rounded-xl mt-5 lg:mt-0">
                        <h2 class="text-xl text-center font-medium mb-4 border-b border-gray-500 pb-2 pt-4">Ubah Informasi Profil</h2>
                        <div class="mb-4 mt-12">
                            <label for="editNama" class="block font-normal text-black mb-2">Nama</label>
                            <input id="editNama" x-model="editUser.nama" :placeholder="user.nama" class="w-full font-normal text-black border focus:outline-[#D3E6DF] rounded p-2" />
                        </div>
                        
                        <div class="mb-4">
                            <label for="editEmail" class="block font-normal text-black mb-2">Email</label>
                            <input id="editEmail" x-model="editUser.email" :placeholder="user.email" class="w-full font-normal text-black border focus:outline-[#D3E6DF] rounded p-2" />
                        </div>
                        <div class="mb-4">
                            <label for="editPassword" class="block font-normal text-black mb-2">Kata Sandi</label>
                            <input type="password" id="editPassword" x-model="editUser.password" :placeholder="user.password" class="w-full font-normal text-black border focus:outline-[#D3E6DF] rounded p-2" />
                        </div>
                        <div class="flex justify-between mt-40 ">
                            <button @click="$refs.fileInput.click()" class="flex items-center justify-center bg-[#22805E] text-white text-[13px] md:text-[14px] lg:text-[13px] font-semibold h-11 w-28 md:w-36 lg:w-28 rounded-lg shadow-md">
                                <svg class="mr-2" width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_933_7015)">
                                    <path d="M19.6663 15.8333C19.6663 16.2754 19.4907 16.6993 19.1782 17.0118C18.8656 17.3244 18.4417 17.5 17.9997 17.5H2.99967C2.55765 17.5 2.13372 17.3244 1.82116 17.0118C1.5086 16.6993 1.33301 16.2754 1.33301 15.8333V6.66667C1.33301 6.22464 1.5086 5.80072 1.82116 5.48816C2.13372 5.17559 2.55765 5 2.99967 5H6.33301L7.99967 2.5H12.9997L14.6663 5H17.9997C18.4417 5 18.8656 5.17559 19.1782 5.48816C19.4907 5.80072 19.6663 6.22464 19.6663 6.66667V15.8333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5003 14.1667C12.3413 14.1667 13.8337 12.6743 13.8337 10.8333C13.8337 8.99238 12.3413 7.5 10.5003 7.5C8.65938 7.5 7.16699 8.99238 7.16699 10.8333C7.16699 12.6743 8.65938 14.1667 10.5003 14.1667Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_933_7015">
                                    <rect width="20" height="20" fill="white" transform="translate(0.5)"/>
                                    </clipPath>
                                    </defs>
                                </svg>    
                                Ganti Foto
                            </button>
                            <button @click="isEditing = false; user = { ...editUser }" class="flex items-center justify-center bg-[#22805E] text-white text-[13px] md:text-[14px] lg:text-[13px] font-semibold h-11 w-28 md:w-36 lg:w-28 rounded-lg shadow-md">
                                <svg class="mr-2" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.66699 3.8335H3.83366C3.39163 3.8335 2.96771 4.00909 2.65515 4.32165C2.34259 4.63421 2.16699 5.05814 2.16699 5.50016V17.1668C2.16699 17.6089 2.34259 18.0328 2.65515 18.3453C2.96771 18.6579 3.39163 18.8335 3.83366 18.8335H15.5003C15.9424 18.8335 16.3663 18.6579 16.6788 18.3453C16.9914 18.0328 17.167 17.6089 17.167 17.1668V11.3335" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M15.917 2.5832C16.2485 2.25168 16.6982 2.06543 17.167 2.06543C17.6358 2.06543 18.0855 2.25168 18.417 2.5832C18.7485 2.91472 18.9348 3.36436 18.9348 3.8332C18.9348 4.30204 18.7485 4.75168 18.417 5.0832L10.5003 12.9999L7.16699 13.8332L8.00033 10.4999L15.917 2.5832Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Perbarui
                            </button>
                        </div>
                        <input type="file" x-ref="fileInput" class="hidden" @change="previewImage">
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