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
<body class="bg-[#F1F5FE] overflow-hidden" x-data="{ sidebarOpen: true }">
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
                <img id="profilePic" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile.png') }}" alt="Profile Picture" class="h-10 w-10 rounded-full">
                <div class="-ml-0 sm:ml-4">
                    <p class="text-[15px] font-semibold text-black sr-only sm:not-sr-only">{{ Auth::user()->name }}</p>
                    <p class="md:text-[15px] text-[#686767] sr-only sm:not-sr-only">Koordinator Pengawas</p>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="{'w-60': sidebarOpen, 'w-16': !sidebarOpen, 'sidebar-visible': sidebarOpen, 'sidebar-hidden': !sidebarOpen}" class="bg-white text-black flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1">
                <ul>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="berandaKoordinatorPengawas" alt="Beranda" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Beranda
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="unggahLaporanKoordinatorPengawas" class="flex items-center text-black font-medium">
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
                        <a href="riwayatLaporanKoordinatorPengawas" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="profilKoordinatorPengawas" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 mt-2">
                        <a href="berandaKoordinatorPengawas" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="unggahLaporanKoordinatorPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riwayatLaporanKoordinatorPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="profilKoordinatorPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Profile">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
        <main :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="flex-1 flex-col transition-all p-4 duration-300 overflow-y-auto pb-24">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/profile.png') }}" alt="Profile" class="h-8 md:h-8 lg:h-10 xl:h-14 w-8 md:w-8 lg:w-10 xl:w-14 rounded-full mr-4">
                    <div>
                        <p class="text-[12px] md:text-[16px] font-semibold">{{ $user->name }}</p>
                        <p class="text-[10px] text-gray-600">{{ $user->role }}</p>
                    </div>
                </div>
                <div class="ml-auto flex items-center justify-center">
                    <a href="{{ route('anggota', ['bidang' => $bidang]) }}" class="flex w-fit items-center justify-center px-6 py-2 text-[11px] md:text-[12px] lg:text-[12px] bg-white rounded-[5px]">
                        <svg class="mr-2 w-3 md:w-3 lg:w-5 h-3 md:h-3 lg:h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
            </div>
        
            <div class="grid grid-col-1 md:grid-cols-2 gap-4 mb-4">
                <!-- Status Pelaporan Mingguan -->
                <div class="bg-white p-4 rounded-[5px] w-5/6 md:w-11/12 lg:w-5/6 xl:w-3/4 ml-1">
                    <p class="text-center text-[11px] md:text-[12px] lg:text-[16px] text-black font-semibold mb-4">Status Pelaporan Mingguan</p>
                    <div class="flex items-center justify-between space-x-6 md:space-x-2 lg:space-x-4 xl:space-x-12 mx-6">
                        <div class="flex space-x-2 lg:space-x-4 xl:space-x-6">
                            @foreach ($statusMingguan as $status)
                                <div class="w-4 md:w-3 lg:w-4 h-4 lg:h-4 md:h-3 {{ $status ? 'bg-[#22805E]' : 'bg-gray-300' }} rounded-full"></div>
                            @endforeach
                        </div>
                        <div class="text-gray-600 md:text-[12px] lg:text-[16px]">{{ count(array_filter($statusMingguan)) }}/4</div>
                        <div class="px-3 md:px-2 lg:px-3 py-1 bg-[#22805E] text-white md:text-[12px] lg:text-[16px] rounded-[5px]">{{ $currentMonth }}</div>
                    </div>
                </div>
        
                <!-- Status Pelaporan Bulanan -->
                <div :class="{'-ml-40': !sidebarOpen}" class="bg-white p-4 rounded-[5px] ml-1 md:-ml-4 lg:-ml-12 xl:-ml-36 mr-[65px] md:mr-0 transition-all duration-300">
                    <p class="text-center text-[11px] md:text-[12px] lg:text-[16px] text-black font-semibold mb-4">Status Pelaporan Bulanan</p>
                    <div class="flex items-center justify-center space-x-7 md:space-x-2 lg:space-x-6 xl:space-x-12 mx-8">
                        <div class="flex flex-col lg:flex-row xl:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                            <div class="grid grid-cols-6 gap-6 md:gap-2 xl:flex xl:space-x-4">
                                @foreach ($statusBulanan as $status)
                                    <div class="w-4 md:w-3 lg:w-4 h-4 lg:h-4 md:h-3 {{ $status ? 'bg-[#22805E]' : 'bg-gray-300' }} rounded-full"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-gray-600 text-[11px] md:text-[12px] lg:text-[16px]">{{ count(array_filter($statusBulanan)) }}/12</div>
                        <button class="px-3 md:px-2 lg:px-2 py-1 bg-[#22805E] text-white text-[11px] md:text-[12px] lg:text-[16px] rounded-[5px]">{{ $currentYear }}</button>
                    </div>
                </div>
            </div>
        
            <div class="flex justify-between items-center mb-4">
                <ul class="flex border bg-[#C5D9CF] rounded-[5px]">
                    <li class="">
                        <a id="mingguan-tab" class="inline-block md:py-1 lg:py-2 px-4 md:w-28 lg:w-36 border text-center bg-[#22805E] rounded-[5px] text-white font-semibold px]cursor-pointer" onclick="showTab('mingguan')">Mingguan</a>
                    </li>
                    <li class="">
                        <a id="bulanan-tab" class="inline-block md:py-1 lg:py-2 px-4 md:w-28 lg:w-36 text-center text-[#22805E] rounded-[5px] font-semibold cursor-pointer" onclick="showTab('bulanan')">Bulanan</a>
                    </li>
                </ul>

                <div class="flex justify-end items-center">
                    <button id="prevPage" class="p-0.5 bg-white rounded-[5px] hover:bg-gray-300" onclick="changePage('prev')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 md:h-4 lg:h-6 w-4 md:w-4 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <span id="paginationInfo" class="bg-[#22805E] text-white font-medium h-5 md:h-5 lg:h-7 w-5 md:w-5 lg:w-7 flex items-center justify-center"></span>
                    <button id="nextPage" class="p-0.5 bg-white rounded-[5px] hover:bg-gray-300" onclick="changePage('next')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 md:h-4 lg:h-6 w-4 md:w-4 lg:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div id="laporan-mingguan" class="category laporan bg-white p-2 w-full rounded-[5px] mx-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">No.</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Judul Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Tanggal Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Unduh Laporan</th>
                        </tr>
                    </thead>
                    <tbody id="mingguanTableBody">

                    </tbody>
                </table>
            </div>
        
            <div id="laporan-bulanan" class="category laporan hidden bg-white p-2 w-full rounded-[5px] mx-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">No.</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Judul Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Tanggal Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Unduh Laporan</th>
                        </tr>
                    </thead>
                    <tbody id="bulananTableBody"></tbody>
                </table>
            </div>
        </main>
    </div> 
    <script>
        let reports = {
            mingguan: {!! json_encode($mingguan->map(function($mingguan) {
                return [
                    'id' => $mingguan->id,
                    'judul' => $mingguan->nama_laporan_with_format,
                    'jenis' => $mingguan->jenis,
                    'tanggal' => $mingguan->created_at->format('d F Y')
                ];
            })) !!},
            bulanan: {!! json_encode($bulanan->map(function($bulanan) {
                return [
                    'id' => $bulanan->id,
                    'judul' => $bulanan->nama_laporan_with_format,
                    'jenis' => $bulanan->jenis,
                    'tanggal' => $bulanan->created_at->format('d F Y')
                ];
            })) !!}
        };
    
        const itemsPerPage = 4;
        let currentPage = { mingguan: 1, bulanan: 1 };
    
        function renderTable(tabName) {
            const tableBody = document.getElementById(`${tabName}TableBody`);
            tableBody.innerHTML = '';
    
            const startIndex = (currentPage[tabName] - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentItems = reports[tabName].slice(startIndex, endIndex);
    
            currentItems.forEach((report, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${startIndex + index + 1}</td>
                    <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.judul}</td>
                    <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.tanggal}</td>
                    <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">
                        <a href="/downloadLaporanPWuntukKoordinatorPengawas/${report.id}" class="text-green-700 flex justify-center">
                            <button>
                                <svg class="w-3 h-6 md:w-5 lg:w-16 md:h-5 lg:h-18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.1291 6.78125H10.5391V1.78125C10.5391 1.23125 10.0891 0.78125 9.53906 0.78125H5.53906C4.98906 0.78125 4.53906 1.23125 4.53906 1.78125V6.78125H2.94906C2.05906 6.78125 1.60906 7.86125 2.23906 8.49125L6.82906 13.0813C7.21906 13.4713 7.84906 13.4713 8.23906 13.0813L12.8291 8.49125C13.4591 7.86125 13.0191 6.78125 12.1291 6.78125ZM0.539062 16.7812C0.539062 17.3312 0.989062 17.7812 1.53906 17.7812H13.5391C14.0891 17.7812 14.5391 17.3312 14.5391 16.7812C14.5391 16.2312 14.0891 15.7812 13.5391 15.7812H1.53906C0.989062 15.7812 0.539062 16.2312 0.539062 16.7812Z" fill="#22805E"/>
                                </svg>
                            </button>
                        </a>
                    </td>
                `;
                tableBody.appendChild(row);
            });
    
            updatePagination(tabName);
        }
    
        function updatePagination(tabName) {
            const pageCount = Math.ceil(reports[tabName].length / itemsPerPage);
            document.getElementById('paginationInfo').textContent = `${currentPage[tabName]}`;
            
            document.getElementById('prevPage').disabled = currentPage[tabName] === 1;
            document.getElementById('nextPage').disabled = currentPage[tabName] === pageCount;
        }
    
        function changePage(direction) {
            const tabName = currentActiveTab;
            const pageCount = Math.ceil(reports[tabName].length / itemsPerPage);
    
            if (direction === 'next' && currentPage[tabName] < pageCount) {
                currentPage[tabName]++;
            } else if (direction === 'prev' && currentPage[tabName] > 1) {
                currentPage[tabName]--;
            }
    
            renderTable(tabName);
        }

        function showTab(tabName) {
            currentActiveTab = tabName;
            
            document.querySelectorAll('.category').forEach(category => {
                category.classList.add('hidden');
            });
            
            document.getElementById(`laporan-${tabName}`).classList.remove('hidden');
            
            document.querySelectorAll('a[id$="-tab"]').forEach(tab => {
                tab.classList.remove('border', 'bg-[#22805E]', 'text-white');
                tab.classList.add('text-[#22805E]');
            });
            
            document.getElementById(`${tabName}-tab`).classList.add('border', 'bg-[#22805E]', 'text-white');
            document.getElementById(`${tabName}-tab`).classList.remove('text-[#22805E]');
            
            renderTable(tabName);
        }
        
        let currentActiveTab = 'mingguan';
    
        // Default tab
        showTab(currentActiveTab);
    </script>                         
</body>
</html>


