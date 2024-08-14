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
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="berandaPemberiLaporan" alt="Beranda" class="flex items-center font-medium">
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
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="pemberitahuan" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a href="berandaPemberiLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a  href="pemberitahuan" class="flex items-center px-5 py-3 bg-[#22805E]" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Pemberitahuan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 8V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 16H12.01" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="riwayatLaporanPemberiLaporan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Riwayat Laporan">
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

        <main :class="sidebarOpen ? 'w-11/12' : 'w-full'" class="flex-1 overflow-y-auto pb-12 transition-all duration-300">
            <div class="grid grid-cols-1 gap-5 p-2 sm:p-8">
                @foreach ($temuans as $temuan)
                    <div class="bg-white p-3 rounded-[5px] drop-shadow-sm">
                        <div class="flex items-center justify-between mx-0 sm:mx-2">
                            <div class="flex items-center justify-center">
                                <svg class="h-6 sm:h-10 w-6 sm:w-10 mr-2" width="55" height="55" viewBox="0 0 356 458" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 50.8571C0 37.369 5.35814 24.4333 14.8957 14.8957C24.4333 5.35814 37.369 0 50.8571 0H171.643C173.329 0 174.946 0.66977 176.138 1.86197C177.33 3.05416 178 4.67112 178 6.35714V127.143C178 140.631 183.358 153.567 192.896 163.104C202.433 172.642 215.369 178 228.857 178H349.643C351.329 178 352.946 178.67 354.138 179.862C355.33 181.054 356 182.671 356 184.357V406.857C356 420.345 350.642 433.281 341.104 442.819C331.567 452.356 318.631 457.714 305.143 457.714H50.8571C37.369 457.714 24.4333 452.356 14.8957 442.819C5.35814 433.281 0 420.345 0 406.857V50.8571Z" fill="#518EF8"/>
                                    <path d="M203.428 127.143V15.3588C203.425 14.0998 203.797 12.8685 204.495 11.821C205.194 10.7734 206.188 9.95688 207.351 9.47478C208.514 8.99269 209.794 8.86678 211.028 9.11301C212.263 9.35925 213.397 9.96654 214.286 10.8579L345.141 141.713C346.033 142.602 346.64 143.736 346.886 144.971C347.132 146.205 347.006 147.485 346.524 148.648C346.042 149.812 345.226 150.805 344.178 151.504C343.131 152.202 341.899 152.574 340.64 152.571H228.856C222.112 152.571 215.644 149.892 210.876 145.123C206.107 140.355 203.428 133.887 203.428 127.143Z" fill="#ACD1FC"/>
                                    <path d="M89 267H241.571M89 343.286H216.143" stroke="white" stroke-width="27" stroke-linecap="round"/>
                                </svg>
                                <div class="flex flex-col justify-center mr-2 max-w-full">
                                    <h2 class="text-sm sm:text-lg font-semibold w-auto overflow-hidden text-ellipsis whitespace-nowrap truncate max-w-[35ch] sm:max-w-[45ch] md:max-w-[40ch] lg:max-w-[40ch] xl:max-w-[70ch]">
                                        {{ $temuan->nama_laporan_with_format}}
                                    </h2>
                                </div>
                            </div>
                            <a href="{{ route('unduhTemuan', ['id' => $temuan->id]) }}" class="flex items-center justify-center bg-[#22805E] text-white font-semibold px-2 sm:px-4 py-1 rounded-[5px] shadow-md hover:bg-green-800" download>
                                <svg class="mr-0 sm:mr-2" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.6621 5.26358C18.4277 4.82275 18.0974 4.42868 17.691 4.10463L14.5243 1.52073C13.8273 0.945762 12.9423 0.589184 12.0016 0.504265H5.4994C4.80016 0.47758 4.10201 0.576322 3.44557 0.794746C2.78914 1.01317 2.18753 1.34691 1.67576 1.77655C1.16399 2.20619 0.752274 2.72315 0.464583 3.29733C0.176893 3.87151 0.0189678 4.49146 0 5.12109V14.9057C0.0373408 15.8552 0.390229 16.7728 1.01306 17.54C1.6359 18.3071 2.50005 18.8885 3.49386 19.2091C4.14029 19.429 4.83034 19.526 5.52051 19.494H13.5004C14.1997 19.5207 14.8978 19.422 15.5543 19.2036C16.2107 18.9851 16.8123 18.6514 17.3241 18.2218C17.8359 17.7921 18.2476 17.2752 18.5353 16.701C18.8229 16.1268 18.9809 15.5068 18.9998 14.8772V6.73603C19.0049 6.22918 18.8898 5.72718 18.6621 5.26358ZM13.5532 12.9393L10.7455 15.4757C10.584 15.6173 10.3942 15.7302 10.186 15.8082C10.0456 15.8652 9.89575 15.9003 9.74269 15.9127C9.60374 15.9412 9.45943 15.9412 9.32048 15.9127C9.16726 15.9003 9.01742 15.865 8.87715 15.8082C8.66899 15.7302 8.47916 15.6173 8.31771 15.4757L5.50995 12.9393C5.33703 12.7576 5.24667 12.5238 5.25693 12.2847C5.26719 12.0456 5.37732 11.8188 5.5653 11.6497C5.75329 11.4805 6.00529 11.3814 6.27095 11.3721C6.5366 11.3629 6.79635 11.4442 6.99827 11.5998L8.47604 12.9298V8.55046C8.47604 8.29851 8.58725 8.05688 8.7852 7.87873C8.98315 7.70058 9.25164 7.60049 9.53158 7.60049C9.81153 7.60049 10.08 7.70058 10.278 7.87873C10.4759 8.05688 10.5871 8.29851 10.5871 8.55046V12.9298L12.0649 11.5998C12.2668 11.4442 12.5266 11.3629 12.7922 11.3721C13.0579 11.3814 13.3099 11.4805 13.4979 11.6497C13.6859 11.8188 13.796 12.0456 13.8062 12.2847C13.8165 12.5238 13.7261 12.7576 13.5532 12.9393ZM13.7854 5.63407C13.6348 5.63532 13.4855 5.60971 13.3459 5.55872C13.2064 5.50772 13.0795 5.43235 12.9725 5.33695C12.8655 5.24156 12.7806 5.12803 12.7227 5.00293C12.6647 4.87783 12.6349 4.74364 12.6349 4.60811V2.0907C12.9304 2.2351 13.2165 2.39659 13.4899 2.57519L16.6565 5.16859C16.8317 5.30158 16.9806 5.45833 17.0999 5.63407H13.7854Z" fill="white"/>
                                </svg>
                                <span class="sr-only sm:not-sr-only">Unduh Temuan</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </main>
        
          
    </div>                         
</body>
</html>