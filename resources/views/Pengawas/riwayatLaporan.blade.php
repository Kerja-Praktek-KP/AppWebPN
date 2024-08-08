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
                <img src="{{ asset('images/profile.png') }}" alt="Profile" class="h-10 w-10 rounded-full">
                <div class="-ml-0 sm:ml-4">
                    <p class="text-[15px] font-semibold text-black sr-only sm:not-sr-only">{{ Auth::user()->name }}</p>
                    <p class="md:text-[15px] text-[#686767] sr-only sm:not-sr-only">Pengawas</p>
                </div>
            </div>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="{'w-60': sidebarOpen, 'w-16': !sidebarOpen, 'sidebar-visible': sidebarOpen, 'sidebar-hidden': !sidebarOpen}" class="bg-white text-black flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1">
                <ul>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="berandaPengawas" alt="Beranda" class="flex items-center font-medium">
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
                        <a href="penilaianDetailPemberiLaporan_Pengawas" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 3.13C16.8604 3.3503 17.623 3.8507 18.1676 4.55231C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                                 
                            Laporan Bidang
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="unggahLaporanPengawas" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Unggah Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="riwayatLaporanPengawas" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="profilPengawas" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 mt-2">
                        <a href="berandaPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-">
                        <a href="penilaianDetailPemberiLaporan_Pengawas" class="px-5 py-3 hover:bg-gray-200" href="#" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Laporan Anggota">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 3.13C16.8604 3.3503 17.623 3.8507 18.1676 4.55231C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="unggahLaporanPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riwayatLaporanPengawas" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="profilPengawas" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Profile">
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
        <main :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="flex-1 flex-col transition-all duration-300 overflow-y-auto mb-20">
            <!-- Tabs -->
            <div class="flex p-8 mx-1">
                <ul class="flex border bg-[#C5D9CF] rounded-md">
                    <li class="">
                        <a id="mingguan-tab" class="inline-block py-1 md:py-2 px-2 md:px-4 w-24 md:w-36 border text-center rounded-[5px] text-[14px] md:text-base text-white font-semibold cursor-pointer" onclick="showTab('mingguan')">Mingguan</a>
                    </li>
                    <li class="">
                        <a id="bulanan-tab" class="inline-block py-1 md:py-2 px-2 md:px-4 w-24 md:w-36 text-center text-[#006634] rounded-[5px] text-[14px] md:text-base font-semibold cursor-pointer" onclick="showTab('bulanan')">Bulanan</a>
                    </li>
                </ul>
            </div>
        
            <!-- Table -->
            <div id="laporan-mingguan" class="category laporan bg-white p-1 md:p-4 w-10/12 md:w-11/12 rounded-[5px] mx-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">No.</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Judul Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Jenis Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Tanggal Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Unduh Laporan</th>
                        </tr>
                    </thead>
                    <tbody id="mingguanTableBody">

                    </tbody>
                </table>
            </div>
        
            <div id="laporan-bulanan" class="category laporan bg-white p-1 md:p-4 w-10/12 md:w-11/12 rounded-[5px] mx-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">No.</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Judul Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Jenis Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Tanggal Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-wider">Unduh Laporan</th>
                        </tr>
                    </thead>
                    <tbody id="bulananTableBody"></tbody>
                </table>
            </div>
        
            <!-- Pagination -->
            <div class="flex justify-end items-center mt-8 mr-16">
                <button id="prevPage" class="p-0.5 bg-white rounded-l-2xl hover:bg-gray-300" onclick="changePage('prev')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 md:h-6 w-4 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <span id="paginationInfo" class="bg-[#22805E] text-white font-medium w-5 md:w-7 h-5 md:h-7 flex items-center justify-center"></span>
                <button id="nextPage" class="p-0.5 bg-white rounded-r-2xl hover:bg-gray-300" onclick="changePage('next')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 md:h-6 w-4 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </main>          
        
        <script>
            let reports = {
                mingguan: [
                    // Data laporan mingguan contoh
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    { id: 1, judul: 'Laporan Mingguan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    // Tambahkan lebih banyak data sesuai kebutuhan
                ],
                bulanan: [
                    // Data laporan bulanan contoh
                    { id: 1, judul: 'Laporan Bulanan', jenis: 'Jenis Laporan', tanggal: '12 September 2024' },
                    // Tambahkan lebih banyak data sesuai kebutuhan
                ]
            };
        
            const itemsPerPage = 7;
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
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.jenis}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.tanggal}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">
                            <button>
                                <svg class="w-3 h-6 md:w-16 md:h-18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.1291 6.78125H10.5391V1.78125C10.5391 1.23125 10.0891 0.78125 9.53906 0.78125H5.53906C4.98906 0.78125 4.53906 1.23125 4.53906 1.78125V6.78125H2.94906C2.05906 6.78125 1.60906 7.86125 2.23906 8.49125L6.82906 13.0813C7.21906 13.4713 7.84906 13.4713 8.23906 13.0813L12.8291 8.49125C13.4591 7.86125 13.0191 6.78125 12.1291 6.78125ZM0.539062 16.7812C0.539062 17.3312 0.989062 17.7812 1.53906 17.7812H13.5391C14.0891 17.7812 14.5391 17.3312 14.5391 16.7812C14.5391 16.2312 14.0891 15.7812 13.5391 15.7812H1.53906C0.989062 15.7812 0.539062 16.2312 0.539062 16.7812Z" fill="#22805E"/>
                                </svg>
                            </button>
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
    </div>                           
</body>
</html>


