<footer class="bg-[#191c1f] text-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 py-12">
            {{-- Logo --}}
            <div class="lg:col-span-2">
                <div class="flex items-center justify-start gap-x-2">
                    <img src="{{ asset('img/application-logo.svg') }}" alt="Logo Aplikasi" class="w-14 h-14" />
                    <div class="leading-0">
                        <h2 class="text-xl font-bold uppercase">Promosi UMKM</h2>
                        <p class="text-gray-100 text-xl capitalize">Minahasa Utara</p>
                    </div>
                </div>

                <p class="max-w-sm mt-3 text-gray-200 leading-relaxed">UMKM Minahasa Utara adalah sebuah platform
                    promosi produk UMKM
                    di
                    Kabupaten Minahasa Utara, Sulawesi Utara.</p>
            </div>

            {{-- Akses Cepat --}}
            <div>
                <h3 class="mb-3 font-bold">Akses Cepat</h3>
                <ul class="space-y-1">
                    <li><a href="{{ route('home') }}" class="hover:underline">Beranda</a></li>
                    <li><a href="{{ route('product.index') }}" class="hover:underline">Produk</a></li>
                    <li><a href="{{ route('selling-guide') }}" class="hover:underline">Mulai Berjualan</a></li>
                    <li><a href="{{ route('help-center') }}" class="hover:underline">Bantuan</a></li>
                </ul>
            </div>

            {{-- Kategori Populer --}}
            <div>
                <h3 class="mb-3 font-bold">Kategori Populer</h3>
                <ul class="space-y-1">
                    <li><a href="{{ route('product.index', ['category' => 'makanan-minuman']) }}"
                            class="hover:underline">Makanan & Minuman</a></li>
                    <li><a href="{{ route('product.index', ['category' => 'fashion-aksesoris']) }}"
                            class="hover:underline">Fashion & Aksesoris</a></li>
                    <li><a href="{{ route('product.index', ['category' => 'kerajinan-handmade']) }}"
                            class="hover:underline">Kerajinan & Handmade</a></li>
                    <li><a href="{{ route('product.index', ['category' => 'destinasi-wisata']) }}"
                            class="hover:underline">Destinasi Wisata</a></li>
                </ul>
            </div>

            {{-- Kontak Kami --}}
            <div>
                <h3 class="mb-3 font-bold">Kontak Kami</h3>
                <ul class="space-y-1">
                    <li>Email: <a href="#" class="text-gray-200 hover:underline">umkmminut@gmail.com</a></li>
                    <li>Instagram: <a href="#" class="text-gray-200 hover:underline">UMKM Airmadidi</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
