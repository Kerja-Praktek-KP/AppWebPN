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
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="berandaPimpinan" alt="Beranda" class="flex items-center text-black font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 3H3V10H10V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 3H14V10H21V3Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21 14H14V21H21V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10 14H3V21H10V14Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                            Beranda
                        </a>
                    </li>
                    <li class="p-3 pl-8 bg-[#22805E] mx-full my-4" x-show="sidebarOpen">
                        <a href="unggahLaporanPimpinan" class="flex items-center text-white font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                    <li class="p-3 pl-8 hover:bg-gray-200 mx-full my-4" x-show="sidebarOpen">
                        <a href="profilPimpinan" class="flex items-center font-medium">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#22805E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a href="unggahLaporanPimpinan" class="bg-[#22805E] px-5 py-3" x-show="!sidebarOpen" title="Unggah Laporan">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 18V12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H15" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                        <a href="profilPimpinan" class="hover:bg-gray-200 px-5 py-3" x-show="!sidebarOpen" title="Profile">
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
        <div class="flex-col bg-white p-2 sm:p-6 lg:p-7 rounded-[5px] ps-2shadow-2xl my-auto mx-auto w-full sm:w-10/12 md:w-8/12 lg:w-7/12 h-fit md:h-auto sm:h-3/4 mt-4 md:mt-5 lg:mt-10 ml-5 md:ml-auto mr-5 md:mr-auto">
            <div class="flex flex-row justify-between items-center mb-6 border-b-2 pb-4">
                <h2 class="text-base md:text-xl lg:text-2xl font-medium">Masukkan Laporan di Sini</h2>
                <button class="bg-[#22805E] text-white text-base md:text-lg font-semibold mt-4 sm:mt-0 mr-0 sm:mr-2 px-3 py-1 rounded-[5px]  hover:bg-[#1A5D45] flex flex-row">
                    <span class="button-text" style="justify-between"> Format Laporan</span>
                    <svg class="my-auto" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.6621 5.26358C18.4277 4.82275 18.0974 4.42868 17.691 4.10463L14.5243 1.52073C13.8273 0.945762 12.9423 0.589184 12.0016 0.504265H5.4994C4.80016 0.47758 4.10201 0.576322 3.44557 0.794746C2.78914 1.01317 2.18753 1.34691 1.67576 1.77655C1.16399 2.20619 0.752274 2.72315 0.464583 3.29733C0.176893 3.87151 0.0189678 4.49146 0 5.12109V14.9057C0.0373408 15.8552 0.390229 16.7728 1.01306 17.54C1.6359 18.3071 2.50005 18.8885 3.49386 19.2091C4.14029 19.429 4.83034 19.526 5.52051 19.494H13.5004C14.1997 19.5207 14.8978 19.422 15.5543 19.2036C16.2107 18.9851 16.8123 18.6514 17.3241 18.2218C17.8359 17.7921 18.2476 17.2752 18.5353 16.701C18.8229 16.1268 18.9809 15.5068 18.9998 14.8772V6.73603C19.0049 6.22918 18.8898 5.72718 18.6621 5.26358ZM13.5532 12.9393L10.7455 15.4757C10.584 15.6173 10.3942 15.7302 10.186 15.8082C10.0456 15.8652 9.89575 15.9003 9.74269 15.9127C9.60374 15.9412 9.45943 15.9412 9.32048 15.9127C9.16726 15.9003 9.01742 15.865 8.87715 15.8082C8.66899 15.7302 8.47916 15.6173 8.31771 15.4757L5.50995 12.9393C5.33703 12.7576 5.24667 12.5238 5.25693 12.2847C5.26719 12.0456 5.37732 11.8188 5.5653 11.6497C5.75329 11.4805 6.00529 11.3814 6.27095 11.3721C6.5366 11.3629 6.79635 11.4442 6.99827 11.5998L8.47604 12.9298V8.55046C8.47604 8.29851 8.58725 8.05688 8.7852 7.87873C8.98315 7.70058 9.25164 7.60049 9.53158 7.60049C9.81153 7.60049 10.08 7.70058 10.278 7.87873C10.4759 8.05688 10.5871 8.29851 10.5871 8.55046V12.9298L12.0649 11.5998C12.2668 11.4442 12.5266 11.3629 12.7922 11.3721C13.0579 11.3814 13.3099 11.4805 13.4979 11.6497C13.6859 11.8188 13.796 12.0456 13.8062 12.2847C13.8165 12.5238 13.7261 12.7576 13.5532 12.9393ZM13.7854 5.63407C13.6348 5.63532 13.4855 5.60971 13.3459 5.55872C13.2064 5.50772 13.0795 5.43235 12.9725 5.33695C12.8655 5.24156 12.7806 5.12803 12.7227 5.00293C12.6647 4.87783 12.6349 4.74364 12.6349 4.60811V2.0907C12.9304 2.2351 13.2165 2.39659 13.4899 2.57519L16.6565 5.16859C16.8317 5.30158 16.9806 5.45833 17.0999 5.63407H13.7854Z" fill="white"/>
                    </svg>                        
                </button>
            </div>
            <form>
                <div class="form-group">
                    <label for="judul" class="block text-[13px] md:text-lg font-medium text-black">Judul Laporan</label>
                    <input type="text" id="judul" name="judul" placeholder="Masukkan Judul Laporan" class="text-[12px] md:text-[14px] pl-3 mt-o md:mt-1 block w-full border-gray-300 rounded-md shadow-md h-10 focus:outline-[#D3E6DF]">
                </div>
                <div class="form-group">
                    <label for="jenis" class="block text-[13px] md:text-lg font-medium text-black">Jenis Laporan</label>
                    <select id="jenis" name="jenis" class="text-[12px] md:text-[14px] custom-caret pl-3 mt-o md:mt-1 block w-full border-gray-300 rounded-md shadow-md h-10 focus:outline-[#D3E6DF]">
                        <option>Laporan TLHP</option>
                        <option>Laporan Eksternal</option>
                    </select>
                </div>
                <style>
                    .custom-caret {
                      appearance: none; /* Hilangkan default caret */
                      background-image: url('data:image/svg+xml;utf8,<svg fill="%2322805E" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>'); /* Ganti warna sesuai keinginan */
                      background-repeat: no-repeat;
                      background-position: right 0.5rem center;
                      background-size: 2rem;
                    }
                </style>
                                  
                                        
                <div class="file-upload-container">
                    <label for="file" class="block text-[13px] md:text-lg font-medium text-black w-2/3 md:w-1/3">Unggah Laporan</label>
                    <div class="mt-o md:mt-6 flex justify-center w-full md:w-8/12 pt-5 pb-6 border-2 bg-[#E1ECE7] border-[#006634] border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" width="52" height="40" viewBox="0 0 52 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M42.0432 16.235C41.5146 7.97 35.8218 0 25.381 0C15.8315 0 8.46733 7.16625 8.07733 16.73C2.85257 18.3713 0 24.0163 0 28.125C0 34.4512 5.20743 40 11.1429 40H19.1905C19.3547 40 19.5121 39.9342 19.6282 39.8169C19.7443 39.6997 19.8095 39.5408 19.8095 39.375C19.8095 39.2092 19.7443 39.0503 19.6282 38.9331C19.5121 38.8158 19.3547 38.75 19.1905 38.75H11.1429C5.8661 38.75 1.2381 33.785 1.2381 28.125C1.2381 24.3113 4.54876 17.5 11.1429 17.5H13C13.1642 17.5 13.3216 17.4342 13.4377 17.3169C13.5538 17.1997 13.619 17.0408 13.619 16.875C13.619 16.7092 13.5538 16.5503 13.4377 16.4331C13.3216 16.3158 13.1642 16.25 13 16.25H11.1429C10.5127 16.25 9.91714 16.3212 9.33648 16.4237C9.82181 8.93625 15.4589 1.25 25.381 1.25C36.0137 1.25 40.8571 9.67375 40.8571 17.5V19.375C40.8571 19.5408 40.9224 19.6997 41.0385 19.8169C41.1546 19.9342 41.312 20 41.4762 20C41.6404 20 41.7978 19.9342 41.9139 19.8169C42.03 19.6997 42.0952 19.5408 42.0952 19.375V17.4888C45.833 17.9025 50.7619 21.9525 50.7619 28.125C50.7619 32.9075 46.1921 38.75 40.8571 38.75H31.5714C27.5625 38.75 26 37.1725 26 33.125V15.9788L31.049 21.0662C31.106 21.126 31.1742 21.1737 31.2497 21.2066C31.3252 21.2394 31.4064 21.2568 31.4886 21.2576C31.5708 21.2585 31.6523 21.2428 31.7284 21.2115C31.8045 21.1801 31.8737 21.1338 31.9319 21.0752C31.9901 21.0166 32.0362 20.9469 32.0674 20.8702C32.0987 20.7934 32.1144 20.7111 32.1138 20.6281C32.1132 20.5452 32.0963 20.4631 32.064 20.3868C32.0316 20.3105 31.9846 20.2415 31.9255 20.1838L26.4024 14.6187C25.667 13.8787 25.0962 13.8787 24.362 14.6187L18.8389 20.1838C18.7261 20.3016 18.6637 20.4595 18.6651 20.6234C18.6665 20.7872 18.7316 20.944 18.8464 21.0599C18.9612 21.1758 19.1164 21.2415 19.2788 21.2429C19.4411 21.2443 19.5974 21.1813 19.7142 21.0675L24.7619 15.9788V33.125C24.7619 37.88 26.8617 40 31.5714 40H40.8571C46.8582 40 52 33.47 52 28.125C52 21.6663 46.7715 16.615 42.0432 16.235Z" fill="#006634"/>
                                </svg>
                            <div class="flex flex-col px-7 items-center text-[13px] md:text-base text-gray-600">
                                <label for="file-upload" class="mr-2 md:mr-0 mt-2 md:mt-0 relative cursor-pointer bg-[#E1ECE7] rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500 flex-shrink-0">
                                    <span>Pilih Berkas</span>
                                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                </label>
                                <p class="text-[13px] md:text-base whitespace-nowrap">atau seret dan letakkan di sini</p>
                                <p class="text-[13px] md:text-base text-gray-500">PDF, DOC, PNG, JPG hingga 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center pb-4">
                    <button type="submit" class="mt-1 lg:mt-6 bg-[#22805E] text-white text-[13px] md:text-lg font-semibold px-6 py-2 rounded-[5px] hover:bg-[#1A5D45]">
                        Unggah
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>