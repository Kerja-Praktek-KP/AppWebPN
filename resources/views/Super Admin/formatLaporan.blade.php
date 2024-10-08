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
            .main-content {
                position: fixed;
                z-index: 10;
                margin-top: 0px; /* Sesuaikan dengan tinggi header */
            }
        }       
    </style>    
    <style>
        /* Default styles for mobile (small screens) */
        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin: 0.5rem;
        }

        .form-group label {
            margin-bottom: 0.5rem;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            height: 2.5rem;
        }

        .file-upload-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin: 1rem;
        }

        .file-upload-container label {
            margin-bottom: 0.5rem;
        }

        .file-upload-area {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 1.5rem;
            border: 2px dashed #ccc;
            border-radius: 0.375rem;
            text-align: center;
        }

        .file-upload-area svg {
            margin-bottom: 0.5rem;
        }

        .file-upload-area label {
            display: inline-block;
            cursor: pointer;
            padding: 0.5rem 1rem;
            background-color: #fff;
            border-radius: 0.375rem;
            color: #2d6a4f;
            border: 1px solid #ccc;
            transition: background-color 0.3s, color 0.3s;
        }

        .file-upload-area label:hover {
            background-color: #f8f9fa;
            color: #1a1a1a;
        }

        .file-upload-area input[type="file"] {
            display: none;
        }

        .file-upload-info {
            text-align: center;
            color: #6c757d;
        }

        /* Styles for larger screens */
        @media (min-width: 768px) {
            .form-group {
                flex-direction: row;
                align-items: center;
            }

            .form-group label {
                margin-bottom: 0;
                margin-right: 1rem;
                width: auto;
                flex: 1;
            }

            .form-group input, .form-group select {
                flex: 2;
            }

            .file-upload-container {
                flex-direction: row;
                align-items: center;
            }

            .file-upload-container label {
                margin-bottom: 0;
                margin-right: 1rem;
                width:100px;
                flex: 1;
            }

            .file-upload-area {
                flex: 2;
                width: auto;
            }
        }
    </style>
    <style>
            .button-text {
            display: inline;
            width: auto;
            margin-right: 1rem;
            flex: 2;
        }
        /* Media query for screens smaller than 640px */
        @media (max-width: 640px) {
            .button-text {
                display: none;
                width: auto;
                padding: 0.5rem 1rem;

            }
        }
    </style>
</head>
<body class="bg-[#F2F3F9] overflow-hidden" x-data="{ sidebarOpen: true }">
    
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
        <div class="mx-8 flex items-center h-10">
            <p class="font-semibold text-black">Super Admin</p>
        </div>
    </header>

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside :class="{'w-60': sidebarOpen, 'w-16': !sidebarOpen, 'sidebar-visible': sidebarOpen, 'sidebar-hidden': !sidebarOpen}" class="bg-white text-black flex flex-col transition-all duration-300 sidebar">
            <nav class="flex-1">
                <ul>
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="kelolaAkun" alt="Beranda" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                 
                            Kelola Akun
                        </a>
                    </li>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="formatLaporan" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a href="kelolaAkun" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Beranda">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </a>
                    </li>
                    <li class="flex justify-center p-2 mx-6">
                        <a href="formatLaporan" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Format Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
        <main class="flex-1 p-2 sm:p-6 lg:p-7 rounded-[5px] my-auto mx-auto w-full h-full justify-between items-center">
            <div class="flex-col bg-white p-2 sm:p-6 lg:p-4 rounded-[5px] my-auto mx-auto w-10/12 md:w-8/12 lg:w-7/12 h-fit md:h-auto sm:h-3/4 mt-4 md:mt-5 lg:mt-10 ml-8 md:ml-auto mr-5 md:mr-auto">
                
                <div class="flex flex-col">
                    <div class="flex items-center justify-between">
                        <div class="flex">
                            <svg class="h-6 sm:h-10 w-6 sm:w-10 mr-2 mt-2" width="55" height="55" viewBox="0 0 356 458" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 50.8571C0 37.369 5.35814 24.4333 14.8957 14.8957C24.4333 5.35814 37.369 0 50.8571 0H171.643C173.329 0 174.946 0.66977 176.138 1.86197C177.33 3.05416 178 4.67112 178 6.35714V127.143C178 140.631 183.358 153.567 192.896 163.104C202.433 172.642 215.369 178 228.857 178H349.643C351.329 178 352.946 178.67 354.138 179.862C355.33 181.054 356 182.671 356 184.357V406.857C356 420.345 350.642 433.281 341.104 442.819C331.567 452.356 318.631 457.714 305.143 457.714H50.8571C37.369 457.714 24.4333 452.356 14.8957 442.819C5.35814 433.281 0 420.345 0 406.857V50.8571Z" fill="#518EF8"/>
                                <path d="M203.428 127.143V15.3588C203.425 14.0998 203.797 12.8685 204.495 11.821C205.194 10.7734 206.188 9.95688 207.351 9.47478C208.514 8.99269 209.794 8.86678 211.028 9.11301C212.263 9.35925 213.397 9.96654 214.286 10.8579L345.141 141.713C346.033 142.602 346.64 143.736 346.886 144.971C347.132 146.205 347.006 147.485 346.524 148.648C346.042 149.812 345.226 150.805 344.178 151.504C343.131 152.202 341.899 152.574 340.64 152.571H228.856C222.112 152.571 215.644 149.892 210.876 145.123C206.107 140.355 203.428 133.887 203.428 127.143Z" fill="#ACD1FC"/>
                                <path d="M89 267H241.571M89 343.286H216.143" stroke="white" stroke-width="27" stroke-linecap="round"/>
                            </svg>
                            <div class="flex flex-col mx-4">
                                <h2 class="text-[12px] md:text-[14px] lg:text-[17px] font-bold">Template Laporan</h2>
                                @foreach ($formats as $reportFormat)
                                    @php
                                        // Misalkan original_name memiliki format: 'Borang KP Panca_24_08_2024.pdf'
                                        $parts = explode('_', $reportFormat->original_name); // Pisahkan berdasarkan underscore (_)
                                        
                                        // Asumsi bagian tanggal, bulan, dan tahun ada di akhir sebelum ekstensi
                                        // Hapus 3 bagian terakhir (tanggal, bulan, tahun)
                                        array_pop($parts); // Hapus bagian tahun
                                        array_pop($parts); // Hapus bagian bulan
                                        array_pop($parts); // Hapus bagian tanggal

                                        $fileNameWithoutDate = implode('_', $parts); // Gabungkan kembali tanpa bagian tanggal, bulan, dan tahun
                                    @endphp
                                    <p class="text-sm text-gray-600 italic">{{ $fileNameWithoutDate }}.pdf</p>
                                @endforeach
              
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <!-- Tombol unduh dan hapus tetap muncul meskipun tidak ada data -->
                            <div class="flex">
                            @if ($formats->isEmpty())
                                <!-- Tampilkan pesan bahwa tidak ada format laporan yang tersedia -->
                                <p class="text-gray-600 italic">Tidak ada format laporan yang tersedia.</p>
                            @else
                                <!-- Tombol unduh -->
                                <a href="{{ route('formatLaporan.download') }}" class="bg-[#22805E] text-white text-[12px] md:text-[14px] lg:text-[17px] font-semibold mt-4 sm:mt-0 mr-0 sm:mr-2 px-2 md:px-2 lg:px-2 xl:px-10 py-1 rounded-[5px] hover:bg-[#1A5D45] flex flex-row">
                                    <span>Unduh</span>
                                </a>

                                <!-- Tombol hapus semua -->
                                <form action="{{ route('formatLaporan.destroyAll') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua format laporan?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-[#FD3259] text-white text-[12px] md:text-[14px] lg:text-[17px] font-semibold mt-4 sm:mt-0 mr-0 sm:mr-2 px-2 md:px-2 lg:px-2 xl:px-10 py-1 rounded-[5px] hover:bg-[#BF2643] flex flex-row">
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            @endif
                        </div>

                        </div>
                    </div>                      
                </div>                
            </div>                    
            
            <div class="flex-col bg-white p-2 sm:p-6 lg:p-7 rounded-[5px] shadow-2xl my-auto mx-auto w-10/12 md:w-8/12 lg:w-7/12 h-fit md:h-auto sm:h-3/4 mt-4 md:mt-5 lg:mt-10 ml-8 md:ml-auto mr-5 md:mr-auto">
                <div class="flex flex-row justify-between items-center mb-6 border-b-2 pb-4">
                    <h2 class="text-[12px] md:text-[14px] lg:text-[17px] font-bold">Masukkan Format Laporan</h2>
                </div>  
                <form action="{{ route('report_formats.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf                                         
                    <div class="file-upload-container">
                        <div class="mt-0 md:mt-6 flex justify-center w-full pt-5 pb-6 border-2 bg-[#E1ECE7] border-[#006634] border-dashed rounded-md" id="file-dropzone">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" width="52" height="40" viewBox="0 0 52 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M42.0432 16.235C41.5146 7.97 35.8218 0 25.381 0C15.8315 0 8.46733 7.16625 8.07733 16.73C2.85257 18.3713 0 24.0163 0 28.125C0 34.4512 5.20743 40 11.1429 40H19.1905C19.3547 40 19.5121 39.9342 19.6282 39.8169C19.7443 39.6997 19.8095 39.5408 19.8095 39.375C19.8095 39.2092 19.7443 39.0503 19.6282 38.9331C19.5121 38.8158 19.3547 38.75 19.1905 38.75H11.1429C5.8661 38.75 1.2381 33.785 1.2381 28.125C1.2381 24.3113 4.54876 17.5 11.1429 17.5H13C13.1642 17.5 13.3216 17.4342 13.4377 17.3169C13.5538 17.1997 13.619 17.0408 13.619 16.875C13.619 16.7092 13.5538 16.5503 13.4377 16.4331C13.3216 16.3158 13.1642 16.25 13 16.25H11.1429C10.5127 16.25 9.91714 16.3212 9.33648 16.4237C9.82181 8.93625 15.4589 1.25 25.381 1.25C36.0137 1.25 40.8571 9.67375 40.8571 17.5V19.375C40.8571 19.5408 40.9224 19.6997 41.0385 19.8169C41.1546 19.9342 41.312 20 41.4762 20C41.6404 20 41.7978 19.9342 41.9139 19.8169C42.03 19.6997 42.0952 19.5408 42.0952 19.375V17.4888C45.833 17.9025 50.7619 21.9525 50.7619 28.125C50.7619 32.9075 46.1921 38.75 40.8571 38.75H31.5714C27.5625 38.75 26 37.1725 26 33.125V15.9788L31.049 21.0662C31.106 21.126 31.1742 21.1737 31.2497 21.2066C31.3252 21.2394 31.4064 21.2568 31.4886 21.2576C31.5708 21.2585 31.6523 21.2428 31.7284 21.2115C31.8045 21.1801 31.8737 21.1338 31.9319 21.0752C31.9901 21.0166 32.0362 20.9469 32.0674 20.8702C32.0987 20.7934 32.1144 20.7111 32.1138 20.6281C32.1132 20.5452 32.0963 20.4631 32.064 20.3868C32.0316 20.3105 31.9846 20.2415 31.9255 20.1838L26.4024 14.6187C25.667 13.8787 25.0962 13.8787 24.362 14.6187L18.8389 20.1838C18.7261 20.3016 18.6637 20.4595 18.6651 20.6234C18.6665 20.7872 18.7316 20.944 18.8464 21.0599C18.9612 21.1758 19.1164 21.2415 19.2788 21.2429C19.4411 21.2443 19.5974 21.1813 19.7142 21.0675L24.7619 15.9788V33.125C24.7619 37.88 26.8617 40 31.5714 40H40.8571C46.8582 40 52 33.47 52 28.125C52 21.6663 46.7715 16.615 42.0432 16.235Z" fill="#006634"/>
                                </svg>
                                <div class="flex flex-col px-7 items-center text-[13px] md:text-base text-gray-600">
                                    <label for="file-upload" class="mr-2 md:mr-0 mt-2 md:mt-0 relative cursor-pointer bg-[#E1ECE7] rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500 flex-shrink-0">
                                        <span>Pilih Berkas</span>
                                        <input id="file-upload" name="file" type="file" class="sr-only" accept=".pdf,.doc,.docx">
                                    </label>
                                    <p class="text-[10px] md:text-[12px] lg:text-base whitespace-nowrap">atau seret dan letakkan di sini</p>
                                    <p class="text-[10px] md:text-[12px] lg:text-base text-gray-500">PDF, DOC, DOCX hingga 10MB</p>
                                </div>
                                <div id="file-selected" class="hidden mt-2 text-green-600">
                                    File telah diseret dan ditempatkan. Siap untuk diunggah.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pb-4">
                        <button type="submit" class="mt-1 lg:mt-6 bg-[#22805E] text-white text-[13px] md:text-lg font-semibold px-10 py-1 rounded-[5px] hover:bg-[#1A5D45]">
                            Unggah
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Pop-up sukses Format Laporan Berhasil ditambahkan -->
    @if(session('success'))
    <div x-data="{ showPopup: true }" x-show="showPopup" class="fixed top-0 right-0 mt-5 mr-5 p-4 bg-green-100 border border-green-400 text-green-700 rounded z-50 popup-success">
        {{ session('success') }}
        <button @click="showPopup = false" class="ml-2 text-green-600"></button>
    </div>
    @endif

    @if($errors->any())
    <div x-data="{ showPopup: true }" x-show="showPopup" class="fixed top-0 right-0 mt-5 mr-5 p-4 bg-red-100 border border-red-400 text-red-700 rounded z-50 flex">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
        <button @click="showPopup = false" class="ml-2 text-red-600">×</button>
    </div>
    @endif


    <script>
        // Script untuk menampilkan popup saat pengguna berhasil ditambahkan
        document.addEventListener('DOMContentLoaded', function () {
            if (document.querySelector('.popup-success')) {
                setTimeout(function () {
                    document.querySelector('.popup-success').classList.add('hidden');
                }, 5000); // 3000 milidetik = 3 detik
        }
        });

        // Script untuk menangani dropzone
        const fileDropzone = document.getElementById('file-dropzone');
        const fileInput = document.getElementById('file-upload');
        const fileSelectedMessage = document.getElementById('file-selected');

        fileDropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileDropzone.classList.add('border-green-500');
        });

        fileDropzone.addEventListener('dragleave', () => {
            fileDropzone.classList.remove('border-green-500');
        });

        fileDropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            fileDropzone.classList.remove('border-green-500');
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                fileSelectedMessage.classList.remove('hidden');
            }
        });

        fileDropzone.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                fileSelectedMessage.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>