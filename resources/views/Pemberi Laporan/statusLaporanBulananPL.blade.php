<!DOCTYPE html>
<html lang="id">
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
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true }">
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
        <div class="flex items-center">
            <div class="mx-2 sm:mx-4 flex items-center">
                <img id="profilePic" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/profile.png') }}" alt="Profile Picture" class="h-10 w-10 rounded-full">
                <div class="-ml-0 sm:ml-4">
                    <p class="text-[15px] font-semibold text-black sr-only sm:not-sr-only">{{ Auth::user()->name }}</p>
                    <p class="md:text-[15px] text-[#686767] sr-only sm:not-sr-only">Pemberi Laporan</p>
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
                        <a href="berandaPemberiLaporan" alt="Beranda" class="flex items-center text-white font-medium">
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
                        <a href="unggahLaporan" class="flex items-center text-black font-medium">
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
                        <a href="pemberitahuan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                                               
                            Pemberitahuan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="riwayatLaporanPemberiLaporan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                            Riwayat Laporan
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="riwayatTLHPPemberiLaporan" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="22" height="24" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 19.5L19 21M12 17C12 17.7956 12.3161 18.5587 12.8787 19.1213C13.4413 19.6839 14.2044 20 15 20C15.7956 20 16.5587 19.6839 17.1213 19.1213C17.6839 18.5587 18 17.7956 18 17C18 16.2044 17.6839 15.4413 17.1213 14.8787C16.5587 14.3161 15.7956 14 15 14C14.2044 14 13.4413 14.3161 12.8787 14.8787C12.3161 15.4413 12 16.2044 12 17Z" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 11V4.749C17.0001 4.67006 16.9845 4.59189 16.9543 4.51896C16.9241 4.44603 16.8798 4.37978 16.824 4.324L13.676 1.176C13.5636 1.06345 13.4111 1.00014 13.252 1H1.6C1.44087 1 1.28826 1.06321 1.17574 1.17574C1.06321 1.28826 1 1.44087 1 1.6V20.4C1 20.5591 1.06321 20.7117 1.17574 20.8243C1.28826 20.9368 1.44087 21 1.6 21H8" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13 1V4.4C13 4.55913 13.0632 4.71174 13.1757 4.82426C13.2883 4.93679 13.4409 5 13.6 5H17" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                                                                                               
                            Riwayat TLHP
                        </a>
                    </li>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="profilPemberiLaporan" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Profil
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6 mt-2">
                        <a href="berandaPemberiLaporan" class="flex items-center px-5 py-3 bg-[#22805E]" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="unggahLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-">
                        <a href="pemberitahuan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Pemberitahuan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riayatLaporanPemberiLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Riwayat Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riwayatTLHPPemberiLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Riwayat TLHP">
                            <svg width="22" height="24" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 19.5L19 21M12 17C12 17.7956 12.3161 18.5587 12.8787 19.1213C13.4413 19.6839 14.2044 20 15 20C15.7956 20 16.5587 19.6839 17.1213 19.1213C17.6839 18.5587 18 17.7956 18 17C18 16.2044 17.6839 15.4413 17.1213 14.8787C16.5587 14.3161 15.7956 14 15 14C14.2044 14 13.4413 14.3161 12.8787 14.8787C12.3161 15.4413 12 16.2044 12 17Z" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 11V4.749C17.0001 4.67006 16.9845 4.59189 16.9543 4.51896C16.9241 4.44603 16.8798 4.37978 16.824 4.324L13.676 1.176C13.5636 1.06345 13.4111 1.00014 13.252 1H1.6C1.44087 1 1.28826 1.06321 1.17574 1.17574C1.06321 1.28826 1 1.44087 1 1.6V20.4C1 20.5591 1.06321 20.7117 1.17574 20.8243C1.28826 20.9368 1.44087 21 1.6 21H8" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M13 1V4.4C13 4.55913 13.0632 4.71174 13.1757 4.82426C13.2883 4.93679 13.4409 5 13.6 5H17" stroke="#22805E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="profilPemberiLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Profile">
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
        <main :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="flex-1 flex-col overflow-y-auto mb-20 mt-12">
            <!-- Tabel Laporan Bulanan -->
            <div id="laporan-bulanan" class="laporan bg-white p-1 md:p-4 w-10/12 md:w-11/12 rounded-[5px] mx-auto">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">No.</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Judul Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Jenis Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Tanggal Laporan</th>
                            <th class="px-2 md:px-5 py-3 text-center text-[10px] md:text-[14px] font-bold text-black uppercase tracking-normal">Unduh Laporan</th>
                        </tr>
                    </thead>
                    <tbody id="bulananTableBody">
                    </tbody>
                </table>
            </div>
        </main>

        <script>
            // Data laporan bulanan yang diambil dari database
            let laporanBulanan = {!! json_encode($laporanBulanan->map(function($laporan) {
                return [
                    'id' => $laporan->id,
                    'judul' => $laporan->nama_laporan_with_format,
                    'jenis' => $laporan->bulan,
                    'tanggal' => $laporan->created_at->format('d F Y')
                ];
            })) !!};

            function renderTable() {
                const tableBody = document.getElementById('bulananTableBody');
                tableBody.innerHTML = '';

                laporanBulanan.forEach((report, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${index + 1}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.judul}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.jenis}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">${report.tanggal}</td>
                        <td class="px-2 md:px-4 py-4 text-center font-medium bg-white text-[8px] md:text-[12px] capitalize">
                            <a href="/downloadstatusLaporanBulananPL/${report.id}" class="text-green-700 flex justify-center" download>
                                <svg class="w-3 h-6 md:w-16 md:h-18" viewBox="0 0 15 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.1291 6.78125H10.5391V1.78125C10.5391 1.23125 10.0891 0.78125 9.53906 0.78125H5.53906C4.98906 0.78125 4.53906 1.23125 4.53906 1.78125V6.78125H2.94906C2.05906 6.78125 1.60906 7.86125 2.23906 8.49125L6.82906 13.0813C7.21906 13.4713 7.84906 13.4713 8.23906 13.0813L12.8291 8.49125C13.4591 7.86125 13.0191 6.78125 12.1291 6.78125ZM0.539062 16.7812C0.539062 17.3312 0.989062 17.7812 1.53906 17.7812H13.5391C14.0891 17.7812 14.5391 17.3312 14.5391 16.7812C14.5391 16.2312 14.0891 15.7812 13.5391 15.7812H1.53906C0.989062 15.7812 0.539062 16.2312 0.539062 16.7812Z" fill="#22805E"/>
                                </svg>
                            </a>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            }

            // Render tabel laporan bulanan saat halaman dimuat
            renderTable();
        </script>

    </div>
</body>
</html>