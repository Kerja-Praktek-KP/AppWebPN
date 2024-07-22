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
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true }">
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
                <ul class="">
                    <li class="p-2 bg-[#F3D910] mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="beranda" alt="Beranda" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a href="riwayatLaporan" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-2 hover:bg-green-600 mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="riwayatTLHP" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 20.5L21 22M14 18C14 18.7956 14.3161 19.5587 14.8787 20.1213C15.4413 20.6839 16.2044 21 17 21C17.7956 21 18.5587 20.6839 19.1213 20.1213C19.6839 19.5587 20 18.7956 20 18C20 17.2044 19.6839 16.4413 19.1213 15.8787C18.5587 15.3161 17.7956 15 17 15C16.2044 15 15.4413 15.3161 14.8787 15.8787C14.3161 16.4413 14 17.2044 14 18Z" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 12V5.749C19.0001 5.67006 18.9845 5.59189 18.9543 5.51896C18.9241 5.44603 18.8798 5.37978 18.824 5.324L15.676 2.176C15.5636 2.06345 15.4111 2.00014 15.252 2H3.6C3.44087 2 3.28826 2.06321 3.17574 2.17574C3.06321 2.28826 3 2.44087 3 2.6V21.4C3 21.5591 3.06321 21.7117 3.17574 21.8243C3.28826 21.9368 3.44087 22 3.6 22H10" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 2V5.4C15 5.55913 15.0632 5.71174 15.1757 5.82426C15.2883 5.93679 15.4409 6 15.6 6H19" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>     
                            Riwayat TLHP                           
                        </a>
                    </li>
                    <li class="p-2 hover:bg-green-600 mx-6 my-4 rounded-lg" x-show="sidebarOpen">
                        <a href="profil" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4">
                        <a href="beranda" class="flex items-center rounded p-1 bg-[#F3D910]" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="unggahLaporan" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="riwayatLaporan" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="riwayatTLHP" x-show="!sidebarOpen" title="Riwayat TLHP">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.5 20.5L21 22M14 18C14 18.7956 14.3161 19.5587 14.8787 20.1213C15.4413 20.6839 16.2044 21 17 21C17.7956 21 18.5587 20.6839 19.1213 20.1213C19.6839 19.5587 20 18.7956 20 18C20 17.2044 19.6839 16.4413 19.1213 15.8787C18.5587 15.3161 17.7956 15 17 15C16.2044 15 15.4413 15.3161 14.8787 15.8787C14.3161 16.4413 14 17.2044 14 18Z" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 12V5.749C19.0001 5.67006 18.9845 5.59189 18.9543 5.51896C18.9241 5.44603 18.8798 5.37978 18.824 5.324L15.676 2.176C15.5636 2.06345 15.4111 2.00014 15.252 2H3.6C3.44087 2 3.28826 2.06321 3.17574 2.17574C3.06321 2.28826 3 2.44087 3 2.6V21.4C3 21.5591 3.06321 21.7117 3.17574 21.8243C3.28826 21.9368 3.44087 22 3.6 22H10" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 2V5.4C15 5.55913 15.0632 5.71174 15.1757 5.82426C15.2883 5.93679 15.4409 6 15.6 6H19" stroke="#F8F8F8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 my-4 rounded-lg">
                        <a href="profil" x-show="!sidebarOpen" title="Profile">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="flex items-center justify-center p-4 border-t-2" x-show="sidebarOpen">
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
        <div :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="p-5 transition-all duration-300 ">
            <div class="grid grid-cols-1 gap-5">
                <!-- Status Pelaporan Mingguan -->
                <div class="bg-white p-3 rounded-lg drop-shadow-2xl">
                    <div class="flex items-center justify-between mx-6">
                        <h2 class="text-base font-semibold w-64">Status Pelaporan Mingguan</h2>
                        <div class="flex items-center justify-center gap-12 flex-grow mr-60">
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 1</span>
                                <div class="bg-green-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 2</span>
                                <div class="bg-red-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 3</span>
                                <div class="bg-orange-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 4</span>
                                <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                            </div>
                        </div>
                        <h2 class="text-base font-semibold">JANUARI</h2>
                    </div>
                </div>
        
                <!-- Status Pelaporan TLHP Mingguan -->
                <div class="bg-white p-3 rounded-lg drop-shadow-2xl">
                    <div class="flex items-center justify-between mx-6">
                        <h2 class="text-base font-semibold w-64">Status Pelaporan TLHP Mingguan</h2>
                        <div class="flex items-center justify-center gap-12 flex-grow mr-60">
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 1</span>
                                <div class="bg-green-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 2</span>
                                <div class="bg-red-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 3</span>
                                <div class="bg-orange-500 w-8 h-8 rounded-full"></div>
                            </div>
                            <div class="flex flex-col items-center">
                                <span class="text-xs mb-2">Minggu 4</span>
                                <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                            </div>
                        </div>
                        <h2 class="text-base font-semibold">JANUARI</h2>
                    </div>
                </div>
        
                <!-- Status Pelaporan Bulanan -->
                <div class="bg-white p-3 rounded-lg drop-shadow-2xl">
                    <div class="flex items-center justify-between mx-6">
                        <h2 class="text-base font-semibold w-64">Status Pelaporan Bulanan</h2>
                        <div class="flex flex-col flex-grow mr-16 ml-4">
                            <div class="flex items-center justify-center gap-5">
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Januari</span>
                                    <div class="bg-green-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Februari</span>
                                    <div class="bg-red-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Maret</span>
                                    <div class="bg-orange-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">April</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Mei</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Juni</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-5 mt-4">
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Juli</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Agustus</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">September</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">November</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Oktober</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Desember</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-base font-semibold text-center">
                            <span>TAHUN</span><br>
                            <span>2024</span>
                        </h2>
                    </div>
                </div>

                <!-- Status Pelaporan TLHP Bulanan -->
                <div class="bg-white p-3 rounded-lg drop-shadow-2xl">
                    <div class="flex items-center justify-between mx-6">
                        <h2 class="text-base font-semibold w-64">Status Pelaporan TLHP Bulanan</h2>
                        <div class="flex flex-col flex-grow mr-16 ml-4">
                            <div class="flex items-center justify-center gap-5">
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Januari</span>
                                    <div class="bg-green-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Februari</span>
                                    <div class="bg-red-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Maret</span>
                                    <div class="bg-orange-500 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">April</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Mei</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Juni</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                            </div>
                            <div class="flex items-center justify-center gap-5 mt-4">
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Juli</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Agustus</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">September</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">November</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Oktober</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                                <div class="flex flex-col items-center w-20">
                                    <span class="text-xs mb-2">Desember</span>
                                    <div class="bg-gray-300 w-8 h-8 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-base font-semibold text-center">
                            <span>TAHUN</span><br>
                            <span>2024</span>
                        </h2>
                    </div>
                </div>                
            </div>
        </div>            
    </div>
</body>
</html>
