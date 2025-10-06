<nav class="bg-[#3e2723] text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10">
        {{-- Atas --}}
        <div class="flex items-center justify-between">
            <ul class="flex items-center gap-x-2 md:gap-x-5 border-white">
                <li><a href="{{ route('selling-guide') }}" class="text-[0.7rem] md:text-xs hover:underline">Mulai
                        Berjualan</a></li>
                <li><a href="{{ route('follow-us') }}" class="text-[0.7rem] md:text-xs hover:underline">Ikuti Kami</a>
                </li>
            </ul>

            <ul class="flex items-center gap-x-2 md:gap-x-5 border-white">
                <li><a href="#" class="text-[0.7rem] md:text-xs hover:underline">Notifikasi</a></li>
                <li><a href="{{ route('help-center') }}" class="text-[0.7rem] md:text-xs hover:underline">Bantuan</a>
                </li>
            </ul>
        </div>

        {{-- Bawah --}}
        <div class="flex flex-col lg:flex-row items-center justify-between gap-2 py-4">
            <a href="{{ route('home') }}" class="flex flex-1 items-center justify-start gap-x-2">
                <img src="{{ asset('img/application-logo.svg') }}" alt="Logo Aplikasi" class="w-10 h-10" />
                <div class="leading-tight">
                    <h3 class="font-bold uppercase">Promosi UMKM</h3>
                    <p class="text-gray-100 capitalize">Minahasa Utara</p>
                </div>
            </a>

            <form action="{{ route('product.index') }}" method="GET"
                class="relative flex justify-center w-full max-w-xl">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Temukan produk di sini..."
                    class="w-full pr-10 pl-3 py-2 bg-white text-black rounded-lg shadow focus:outline-none" />

                <input type="hidden" name="category" value="{{ request('category') }}">

                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-gray-400 cursor-pointer hover:text-blue-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </button>
            </form>

            <div class="flex flex-1 justify-end">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" type="button" aria-label="User Button"
                            class="p-2 rounded-full cursor-pointer hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                            </svg>
                        </button>

                        <div x-show="open" x-cloak @click.outside="open = false" x-transition
                            class="absolute right-1/2 translate-x-1/2 lg:right-0 lg:translate-x-0 w-48 mt-2 bg-white border border-gray-300 rounded-lg shadow overflow-hidden z-50">
                            <div class="block px-4 py-2 leading-none border-b border-gray-500">
                                <h3 class="text-black font-semibold line-clamp-1">{{ auth()->user()->name }}</h3>
                                <p class="text-sm text-gray-800">{{ auth()->user()->role }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">Profil
                                Saya</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100">Usaha Saya</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                    class="block w-full px-4 py-2 text-sm text-start text-red-600 cursor-pointer hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" aria-label="User Button" class="p-2 rounded-full hover:bg-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
