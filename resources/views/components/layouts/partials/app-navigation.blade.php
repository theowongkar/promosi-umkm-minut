<div x-show="sidebarOpen" @click="sidebarOpen = false"
    class="fixed inset-0 bg-black/50 z-20 transition-opacity scrollbar-custom md:hidden"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
</div>

{{-- Sidebar Utama --}}
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 transform bg-[#3e2723] text-white transition duration-300 md:translate-x-0 md:static md:inset-0 flex flex-col">

    {{-- Header Sidebar --}}
    <div class="flex items-center mb-5 space-x-3 px-4 py-4">
        {{-- Logo Gambar --}}
        <img src="{{ asset('img/application-logo.svg') }}" alt="Logo Aplikasi"
            class="w-14 h-14 object-contain rounded-full">

        {{-- Tulisan --}}
        <div class="leading-tight">
            <h2 class="font-semibold uppercase">Promosi UMKM Minut</h2>
            <span class="text-sm text-gray-300">Sulawesi Utara</span>
        </div>
    </div>

    {{-- Navigasi Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 space-y-5">
        {{-- Menu --}}
        <div class="space-y-2">
            <h1 class="mb-1 text-xs text-gray-300 font-bold uppercase">Menu</h1>
            <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-3 px-4 py-2 text-gray-200 text-sm font-semibold rounded-md hover:bg-white/10 {{ Route::is('dashboard') ? 'bg-white/10 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path
                        d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
                </svg>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- User --}}
        <div class="space-y-2">
            <h1 class="mb-1 text-xs text-gray-300 font-bold uppercase">User</h1>
            <a href="{{ route('dashboard.user.index') }}"
                class="flex items-center space-x-3 px-4 py-2 text-gray-200 text-sm font-semibold rounded-md hover:bg-white/10 {{ Route::is('dashboard.user.*') ? 'bg-white/10 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                </svg>
                <span>Data User</span>
            </a>
        </div>

        {{-- Kategori --}}
        <div class="space-y-2">
            <h1 class="mb-1 text-xs text-gray-300 font-bold uppercase">Kategori</h1>
            <a href="{{ route('dashboard.business-category.index') }}"
                class="flex items-center space-x-3 px-4 py-2 text-gray-200 text-sm font-semibold rounded-md hover:bg-white/10 {{ Route::is('dashboard.business-category.index') ? 'bg-white/10 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-tags-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                    <path
                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                </svg>
                <span>Kategori Bisnis</span>
            </a>
            <a href="{{ route('dashboard.product-category.index') }}"
                class="flex items-center space-x-3 px-4 py-2 text-gray-200 text-sm font-semibold rounded-md hover:bg-white/10 {{ Route::is('dashboard.product-category.index') ? 'bg-white/10 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-tags-fill" viewBox="0 0 16 16">
                    <path
                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                    <path
                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                </svg>
                <span>Kategori Produk</span>
            </a>
        </div>

        {{-- Utama --}}
        <div class="space-y-2">
            <h1 class="mb-1 text-xs text-gray-300 font-bold uppercase">Utama</h1>
            <a href="{{ route('dashboard.business.index') }}"
                class="flex items-center space-x-3 px-4 py-2 text-gray-200 text-sm font-semibold rounded-md hover:bg-white/10 {{ Route::is('dashboard.business.*') ? 'bg-white/10 text-white' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-shop" viewBox="0 0 16 16">
                    <path
                        d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z" />
                </svg>
                <span>Data Usaha</span>
            </a>
        </div>
    </nav>
</div>
