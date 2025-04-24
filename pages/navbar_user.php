    <header class="bg-black fixed w-full z-50 shadow-md">
        <nav class="flex justify-between items-center w-[90%] mx-auto py-3">
            <div class="flex items-center gap-2">
                <img src="/FlexDrive/images/logo_horizontal.png" alt="FlexDrive" class="w-[150px]">
            </div>

            <!-- Menu -->
            <div id="nav-links" class="text-gray-300 md:static fixed bg-black md:min-h-fit min-h-[35vh] top-[-100%] md:w-auto w-full left-0 flex flex-col items-center py-3 transition-all duration-500 ease-in-out">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-10 gap-4">
                    <li><a class="hover:text-gray-400 transition text-white" href="home_user.php">Beranda</a></li>
                    <li><a class="hover:text-gray-400 transition text-white" href="akun.php">Akun</a></li>
                    <li><a class="hover:text-gray-400 transition text-white" href="list_mobil.php">List Mobil</a></li>
                </ul>
            </div>

            <!-- Search & Mobile Menu -->
            <div class="flex items-center gap-4">
                <input type="text" placeholder="Cari..." class="text-black rounded-full border border-gray-500 px-4 py-1 focus:outline-none focus:ring-2 focus:ring-gray-600 w-[120px] h-[35px] md:w-[200px] transition-all duration-300">
                <ion-icon id="menu-icon" name="menu" class="text-3xl text-white cursor-pointer md:hidden"></ion-icon>
            </div>
        </nav>
</header>