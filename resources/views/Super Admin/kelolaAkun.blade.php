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
                            Template Laporan
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

        <main :class="sidebarOpen ? 'w-11/12 ' : 'w-full'" class="flex-1 p-8 overflow-y-auto pb-20 transition-all duration-300">
            <div class="grid-cols-2 grid gap-6 h-1/4">
                @foreach($targetUsers as $targetUser)
                    @if(Auth::user()->role === 'Super Admin')
                        @if($targetUser->role == 'Pimpinan')
                            <a href="{{ route('users.akunPimpinan') }}" class="bg-white p-2 rounded-lg hover:shadow-lg w-full transition ease-in-out delay-150 hover:-translate-y-0 hover:scale-105 hover:bg-white duration-300 flex flex-col justify-start items-center">
                                <div class="flex flex-col justify-start items-center h-14">
                                    <p class="text-sm md:text-base font-semibold text-black mt-5 md:mt-4">Pimpinan</p>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
                @foreach($targetUsers as $targetUser)
                    @if(Auth::user()->role === 'Super Admin')
                        @if($targetUser->role == 'Koordinator Pengawas')
                            <a href="{{ route('users.akunKoordinatorPengawas') }}" class="bg-white p-2 rounded-lg hover:shadow-lg w-full transition ease-in-out delay-150 hover:-translate-y-0 hover:scale-105 hover:bg-white duration-300 flex flex-col justify-start items-center">
                                <div class="flex flex-col justify-start items-center h-14">
                                    <p class="text-sm md:text-base font-semibold text-black mt-5 md:mt-4">Koordinator Pengawas</p>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
                @if(Auth::user()->role === 'Super Admin')    
                    @foreach($groupedUsers as $bidang => $users)
                        @if($bidang && in_array($bidang, $validBidangs))
                        <a href="{{ route('anggota', ['bidang' => $bidang]) }}" class="bg-white p-2 rounded-lg w-full transition ease-in-out delay-150 hover:-translate-y-0 hover:scale-105 hover:bg-white duration-300 flex flex-col justify-start items-center">
                            <div class="flex flex-col justify-start items-center h-14">
                                <p class="text-sm md:text-base font-semibold text-black mt-5 md:mt-4">{{ $bidang }}</p>
                            </div>
                        </a>
                        @endif
                    @endforeach
                @endif
            </div>
        </main>
    </div>
</body>
</html>
