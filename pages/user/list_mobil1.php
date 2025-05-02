<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        ion-icon {
            color: white;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            scrollbar-width: none;  
        }
    </style>
    </style>
    <title>List Mobil | FlexDrive</title>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="bg-black fixed w-full z-50 shadow-md">
        <nav class="flex justify-between items-center w-[90%] mx-auto py-3">
            <div class="flex items-center gap-2">
                <img src="../../images/logo_horizontal.png" alt="FlexDrive" class="w-[150px]">
            </div>

            <!-- Menu -->
            <div id="nav-links" class="text-gray-300 md:static fixed bg-black md:min-h-fit min-h-[35vh] top-[-100%] md:w-auto w-full left-0 flex flex-col items-center py-3 transition-all duration-500 ease-in-out">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-10 gap-4">
                    <li><a class="hover:text-gray-400 transition text-white" href="../../pages/index.php">Beranda</a></li>
                    <li class="md:hidden"><a class="hover:text-gray-400 transition" href="../../pages/sign_up.html">Daftar</a></li>
                    <li><a class="hover:text-gray-400 transition text-white" href="user/list_mobil1.php">List Mobil</a></li>
                </ul>
            </div>
            <!-- Search & Mobile Menu -->
            <div class="flex items-center gap-4">
            <!-- Tombol Daftar di Desktop -->
            <a href="../../pages/sign_in.html" class="hidden md:block bg-red-600 text-white font-semibold px-6 py-2 rounded-lg shadow-md hover:bg-red-700 transition-all duration-300">Daftar</a>

            <!-- Toggle Menu Mobile -->
            <ion-icon id="menu-icon" name="menu" class="text-3xl text-white cursor-pointer md:hidden"></ion-icon>
    </header>

    <!-- Search by Categories -->
    <section class="px-6 md:px-12 py-10 mb-10">
        <h2 class="text-3xl font-bold mt-11 mb-6  text-gray-900">Search by Categories</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8 gap-4">

        <!-- Category Buttons -->
        <a href="#mpv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MPV</a>
        <a href="#suv" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">SUV</a>
        <a href="#hatchback" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">HATCHBACK</a>
        <a href="#minibus" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MINIBUS</a>
        <a href="#manual" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">MANUAL</a>
        <a href="#automatic" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">AUTO</a>
        <a href="#bensin" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">BENSIN</a>
        <a href="#diesel" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-full text-center transition duration-300">DIESEL</a>

        </div>
    </section>

        <!-- Tipe MPV -->
        <section class="relative p-4" id="mpv">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">MPV</h2>
            <div class="relative flex items-center">
                <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg lg:hidden">
                    &#10094;
                </button>
                

                <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                        <img src="../../images/toyota-venturer.png" alt="Toyota Innova Venturer" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">2018 Innova Venturer</h3>
                            <p class="text-gray-500 text-sm">TOYOTA - Model year 2019</p>
                            <div class="text-sm mt-2 space-y-1">
                                <p><strong>Body type:</strong> MPV</p>
                                <p><strong>Engine:</strong> 2.4L 4-Cylinder DOHC (Diesel)</p>
                                <p><strong>Transmission:</strong> 6-Speed Automatic</p>
                                <p><strong>Interior & exterior colors:</strong> Silver</p>
                                <p><strong>Seats:</strong> 7</p>
                            </div>
                            <p class="mt-3 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.800.000</p>
                        </div>
                    </div>
                
                    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                        <img src="../../images/Suzuki Ertiga 2021.png" alt="Suzuki Ertiga" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">2021 Suzuki Ertiga</h3>
                            <p class="text-gray-500 text-sm">Suzuki - Model year 2021</p>
                            <div class="text-sm mt-2 space-y-1">
                                <p><strong>Body type:</strong> MPV</p>
                                <p><strong>Engine:</strong> 1.5L K15B</p>
                                <p><strong>Transmission:</strong> Automatic</p>
                                <p><strong>Interior & exterior colors:</strong> Coklat</p>
                                <p><strong>Seats:</strong> 7</p>
                            </div>
                            <p class="mt-3 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                        </div>
                    </div>
                    
                    <a href="../sign_in.html"><div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                        <img src="../../images/toyota-veloz 2021.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">2021 Toyota Veloz</h3>
                            <p class="text-gray-500 text-sm">TOYOTA - Model year 2021</p>
                            <div class="text-sm mt-2 space-y-1">
                                <p><strong>Body type:</strong> MPV</p>
                                <p><strong>Engine:</strong> 1.5L 4-Cylinder DOHC Dual VVT-i</p>
                                <p><strong>Transmission:</strong> CVT (Continuously Variable Transmission)</p>
                                <p><strong>Interior & exterior colors:</strong> hitam, silver</p>
                                <p><strong>Seats:</strong> 7</p>
                            </div>
                            <p class="mt-3 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                        </div>
                    </div></a>
                    
                    <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                        <img src="../../images/Daihatsu Xenia 2020.png" alt="Daihatsu Xenia" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">2021 Daihatsu Xenia</h3>
                            <p class="text-gray-500 text-sm">Daihatsu - Model year 2021</p>
                            <div class="text-sm mt-2 space-y-1">
                                <p><strong>Body type:</strong> MPV</p>
                                <p><strong>Engine:</strong> 1.5L Dual VVT-i</p>
                                <p><strong>Transmission:</strong> 1.5L Dual VVT-i</p>
                                <p><strong>Interior & exterior colors:</strong> Putih</p>
                                <p><strong>Seats:</strong> 7</p>
                            </div>
                            <p class="mt-3 text-gray-500">Start from</p>
                            <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                        </div>
                    </div>
                    
                </div>
                
                <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg lg:hidden">
                    &#10095;
                </button>
            </div>
        </section>    

            


    <!-- Tipe: SUV -->

    <section class="relative p-4" id="suv">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">SUV</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Toyota Rush 2018.png" alt="Toyota Innova Venturer" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Toyota Rush</h3>
                        <p class="text-gray-500 text-sm">Toyota - Model year 2018</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> SUV</p>
                            <p><strong>Engine:</strong> 1.5L 2NR-VE Dual VVT-i</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Coklat</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.400.000</p>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda CR-V 2019.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2019 Honda CR-V</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2019</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> SUV</p>
                            <p><strong>Engine:</strong> 2.0L i-VTEC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Hitam</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Tipe: Hatchback -->

    <section class="relative p-4" id="hatchback">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Hatchback</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/agya sport 2021.png" alt="Toyota Agya" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Agya Sport</h3>
                        <p class="text-gray-500 text-sm">Toyota - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L 3NR-VE Dual VVT-i</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Merah</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>   
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda Brio 2022.png" alt="Honda Brio" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Honda Brio</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L i-VTEC SOHC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Putih</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10095;
            </button>
        </div>
    </section>


    <!-- Tipe: Minibus -->
    <section class="relative p-4" id="minibus">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Minibus</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg hidden">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Hiiace 2018.png" alt="Hiace" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Hiace Premio</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2018</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Van</p>
                            <p><strong>Engine:</strong> 2.8L 4-Cylinder Turbo Diesel</p>
                            <p><strong>Transmission:</strong> 6-Speed Manual</p>
                            <p><strong>Interior & exterior colors:</strong> black, white</p>
                            <p><strong>Seats:</strong> 15</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.1.000.000</p>
                    </div>
                </div>   
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg hidden">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Tipe: Manual -->
    <section class="relative p-4" id="manual">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Manual</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Hiiace 2018.png" alt="Hiace" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Hiace Premio</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2018</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Van</p>
                            <p><strong>Engine:</strong> 2.8L 4-Cylinder Turbo Diesel</p>
                            <p><strong>Transmission:</strong> 6-Speed Manual</p>
                            <p><strong>Interior & exterior colors:</strong> black, white</p>
                            <p><strong>Seats:</strong> 15</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.1.000.000</p>
                    </div>
                </div>  
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/toyota-veloz 2021.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Toyota Veloz</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L 4-Cylinder DOHC Dual VVT-i</p>
                            <p><strong>Transmission:</strong> CVT (Continuously Variable Transmission)</p>
                            <p><strong>Interior & exterior colors:</strong> hitam, silver</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Daihatsu Xenia 2020.png" alt="Daihatsu Xenia" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Daihatsu Xenia</h3>
                        <p class="text-gray-500 text-sm">Daihatsu - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L Dual VVT-i</p>
                            <p><strong>Transmission:</strong> 1.5L Dual VVT-i</p>
                            <p><strong>Interior & exterior colors:</strong> Putih</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Tipe: Automatic -->
    <section class="relative p-4" id="automatic">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Automatic</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/toyota-venturer.png" alt="Toyota Innova Venturer" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Innova Venturer</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2019</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 2.4L 4-Cylinder DOHC (Diesel)</p>
                            <p><strong>Transmission:</strong> 6-Speed Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Silver</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.800.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Suzuki Ertiga 2021.png" alt="Suzuki Ertiga" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Suzuki Ertiga</h3>
                        <p class="text-gray-500 text-sm">Suzuki - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L K15B</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Coklat</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda CR-V 2019.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2019 Honda CR-V</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2019</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> SUV</p>
                            <p><strong>Engine:</strong> 2.0L i-VTEC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Hitam</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/agya sport 2021.png" alt="Toyota Agya" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Agya Sport</h3>
                        <p class="text-gray-500 text-sm">Toyota - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L 3NR-VE Dual VVT-i</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Merah</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda Brio 2022.png" alt="Honda Brio" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Honda Brio</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L i-VTEC SOHC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Putih</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Bensin -->
    <section class="relative p-4" id="bensin">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Bensin</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/toyota-veloz 2021.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Toyota Veloz</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L 4-Cylinder DOHC Dual VVT-i</p>
                            <p><strong>Transmission:</strong> CVT (Continuously Variable Transmission)</p>
                            <p><strong>Interior & exterior colors:</strong> hitam, silver</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Suzuki Ertiga 2021.png" alt="Suzuki Ertiga" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Suzuki Ertiga</h3>
                        <p class="text-gray-500 text-sm">Suzuki - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L K15B</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Coklat</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda CR-V 2019.png" alt="Toyota Veloz 2021" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2019 Honda CR-V</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2019</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> SUV</p>
                            <p><strong>Engine:</strong> 2.0L i-VTEC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Hitam</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Daihatsu Xenia 2020.png" alt="Daihatsu Xenia" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2021 Daihatsu Xenia</h3>
                        <p class="text-gray-500 text-sm">Daihatsu - Model year 2021</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 1.5L Dual VVT-i</p>
                            <p><strong>Transmission:</strong> 1.5L Dual VVT-i</p>
                            <p><strong>Interior & exterior colors:</strong> Putih</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.600.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/agya sport 2021.png" alt="Toyota Agya" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Agya Sport</h3>
                        <p class="text-gray-500 text-sm">Toyota - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L 3NR-VE Dual VVT-i</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Merah</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Honda Brio 2022.png" alt="Honda Brio" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2022 Honda Brio</h3>
                        <p class="text-gray-500 text-sm">Honda - Model year 2022</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Hatchback</p>
                            <p><strong>Engine:</strong> 1.2L i-VTEC SOHC</p>
                            <p><strong>Transmission:</strong> CVT</p>
                            <p><strong>Interior & exterior colors:</strong> Putih</p>
                            <p><strong>Seats:</strong> 5</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.300.000</p>
                    </div>
                </div>

                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Toyota Rush 2018.png" alt="Toyota Innova Venturer" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Toyota Rush</h3>
                        <p class="text-gray-500 text-sm">Toyota - Model year 2018</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> SUV</p>
                            <p><strong>Engine:</strong> 1.5L 2NR-VE Dual VVT-i</p>
                            <p><strong>Transmission:</strong> Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Coklat</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.400.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg">
                &#10095;
            </button>
        </div>
    </section>

    <!-- Diesel -->
    <section class="relative p-4" id="diesel">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Diesel</h2>
        <div class="relative flex items-center">
            <button class="prev-btn absolute left-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10094;
            </button>
            
            <div class="car-list flex space-x-6 overflow-x-auto pb-4 scrollbar-hide w-full px-10">
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/toyota-venturer.png" alt="Toyota Innova Venturer" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Innova Venturer</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2019</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> MPV</p>
                            <p><strong>Engine:</strong> 2.4L 4-Cylinder DOHC (Diesel)</p>
                            <p><strong>Transmission:</strong> 6-Speed Automatic</p>
                            <p><strong>Interior & exterior colors:</strong> Silver</p>
                            <p><strong>Seats:</strong> 7</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.800.000</p>
                    </div>
                </div>
                
                <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200 transition-all hover:scale-105 hover:shadow-2xl w-64 flex-none">
                    <img src="../../images/Hiiace 2018.png" alt="Hiace" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">2018 Hiace Premio</h3>
                        <p class="text-gray-500 text-sm">TOYOTA - Model year 2018</p>
                        <div class="text-sm mt-2 space-y-1">
                            <p><strong>Body type:</strong> Van</p>
                            <p><strong>Engine:</strong> 2.8L 4-Cylinder Turbo Diesel</p>
                            <p><strong>Transmission:</strong> 6-Speed Manual</p>
                            <p><strong>Interior & exterior colors:</strong> black, white</p>
                            <p><strong>Seats:</strong> 15</p>
                        </div>
                        <p class="mt-3 text-gray-500">Start from</p>
                        <p class="text-lg font-bold text-green-600">Rp.1.000.000</p>
                    </div>
                </div>
            </div>
            
            <button class="next-btn absolute right-0 bg-black hover:bg-gray-700 text-white p-3 rounded-full z-50 shadow-lg md:hidden">
                &#10095;
            </button>
        </div>
    </section>
    
    <button id="scrollToTop" class="hidden fixed bottom-8 right-8 bg-black hover:bg-gray-600 text-white p-4 rounded-full shadow-lg transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <!-- Tentang Kami -->
    <section id="tentang_kami" class="bg-black text-white py-14 px-6 md:px-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center gap-8">
    
            <!-- Bagian Teks -->
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4">Tentang Kami</h2>
                <p class="mb-6 text-justify leading-relaxed">
                    FlexDrive hadir untuk memudahkan perjalanan Anda dengan layanan rental mobil cepat, aman, dan tanpa ribet.
                    Dengan berbagai pilihan mobil, kami memastikan pengalaman sewa yang nyaman dan terpercaya.
                </p>
    
                <!-- Contact Info -->
                <h3 class="text-xl font-semibold mb-3">Contact</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <img src="../../images/Location putih.png" alt="Lokasi" class="w-6 h-6">
                        <span>Jalan Gandhi No. 99A</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="../../images/Phone.png" alt="Telepon" class="w-6 h-6">
                        <span>084978652349</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="../../images/email.png" alt="Email" class="w-6 h-6">
                        <span>customerservice@flexdrive.com</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="../../images/jam.png" alt="Jam Operasional" class="w-6 h-6">
                        <div class="flex flex-col">
                            <span class="font-bold">Jam Operasional</span>
                            <span>Senin-Sabtu: 07:00AM - 11:00PM</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Bagian Logo -->
            <div class="md:w-1/2 flex justify-center">
                <img src="../../images/logoFlexDrive.png" alt="FlexDrive Logo" class="w-2/3 md:w-1/2 h-auto">
            </div>
    
        </div>
    </section>

    <script>
        document.querySelectorAll(".prev-btn").forEach(button => {
            button.addEventListener("click", () => {
                const carList = button.closest("section").querySelector(".car-list");
                carList.scrollBy({ left: -320, behavior: "smooth" });
            });
        });

        document.querySelectorAll(".next-btn").forEach(button => {
            button.addEventListener("click", () => {
                const carList = button.closest("section").querySelector(".car-list");
                carList.scrollBy({ left: 320, behavior: "smooth" });
            });
        });

        const scrollToTopBtn = document.getElementById("scrollToTop");

        window.addEventListener("scroll", function () {
            if (window.scrollY > 300) {
                scrollToTopBtn.classList.remove("hidden");
            } else {
                scrollToTopBtn.classList.add("hidden");
            }
        });

        scrollToTopBtn.addEventListener("click", function () {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
        
        const navLinks = document.getElementById("nav-links");
        const menuIcon = document.getElementById("menu-icon");

        menuIcon.addEventListener("click", () => {
            if (navLinks.classList.contains("top-12")) {
                navLinks.classList.remove("top-12");
                navLinks.classList.add("top-[-500px]");
                menuIcon.name = "menu";
            } else {
                navLinks.classList.remove("top-[-500px]");
                navLinks.classList.add("top-12");
                menuIcon.name = "close";
            }
        });
    </script>
    
</body>
</html>

