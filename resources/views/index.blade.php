<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Home</x-slot>

    {{-- Bagian Banner --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8 space-y-8">
            <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
                <img src="{{ asset('img/banner/cosmetics.webp') }}" alt="Kecantikan & Perawatan"
                    class="w-full h-40 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/farm.webp') }}" alt="Pertanian, Perikanan & Peternakan"
                    class="w-full h-40 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/fruit-store.webp') }}" alt="Makanan & Minuman"
                    class="w-full h-40 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/destination.webp') }}" alt="Destinasi Wisata"
                    class="hidden md:block row-span-2 w-full h-84 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/grocery-store.webp') }}" alt="Jasa & Layanan"
                    class="w-full h-40 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/handycraft.webp') }}" alt="Kerajinan & Handmade"
                    class="w-full h-40 object-cover rounded-lg" />
                <img src="{{ asset('img/banner/kabasaran.webp') }}" alt="Fashion & Aksesoris"
                    class="w-full h-40 object-cover rounded-lg" />
            </div>

            <div class="flex flex-col md:flex-row overflow-hidden rounded-lg shadow">
                <div class="order-2 md:order-1 w-full md:w-3/4 p-5 space-y-4 bg-[#c5e1a5]">
                    <h2 class="text-xl lg:text-4xl font-bold">Ingin Meningkatkan Omzet Penjualan?</h2>
                    <p class="text-base lg:text-xl">Ayo daftarkan usahamu sekarang di sini!</p>
                    <a href="{{ route('selling-guide') }}"
                        class="px-3 py-2 bg-[#3e2723] text-white font-bold rounded-md cursor-pointer">Gabung
                        Sekarang</a>
                </div>
                <div class="order-1 md:order-2 w-full">
                    <img src="{{ asset('img/gallery/lets-join.webp') }}" alt="Ayo Bergabung"
                        class="w-full h-56 object-cover" />
                </div>
            </div>
        </div>
    </section>

    {{-- Bagian Kategori Produk --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8" x-data="{
            currentIndex: 0,
            totalItems: {{ $productCategories->count() }},
            itemsPerView: 1,
            itemWidth: 0,
            setItemsPerView() {
                const width = window.innerWidth;
                if (width >= 1280) this.itemsPerView = 8; // xl
                else if (width >= 1024) this.itemsPerView = 6; // lg
                else if (width >= 768) this.itemsPerView = 6; // md
                else this.itemsPerView = 3;
                this.itemWidth = this.$refs.track.clientWidth / this.itemsPerView;
            },
            goTo(index) { this.currentIndex = index; },
            init() {
                this.setItemsPerView();
                window.addEventListener('resize', () => this.setItemsPerView());
            }
        }"
            x-init="init()">

            <h2 class="mb-5 text-xl font-bold">Kategori Produk</h2>

            <div class="overflow-hidden relative">
                <div class="flex transition-transform duration-300"
                    :style="`transform: translateX(-${currentIndex * itemWidth}px)`" x-ref="track">
                    @forelse ($productCategories as $productCategory)
                        <div class="flex-shrink-0 px-2" :style="`width: ${itemWidth}px`">
                            <a href="{{ route('product.index', ['category' => $productCategory->slug]) }}"
                                aria-label="Kategori Produk">
                                <img src="{{ $productCategory->image_path ? asset('storage/' . $productCategory->image_path) : asset('img/placeholder-image.webp') }}"
                                    alt="{{ implode(' ', array_slice(explode(' ', $productCategory->name), 0, 2)) }}"
                                    class="w-full aspect-square object-cover border border-gray-300 rounded-lg shadow" />
                            </a>
                            <h3 class="mt-2 text-sm text-center">{{ $productCategory->name }}</h3>
                        </div>
                    @empty
                        <p class="text-lg font-semibold text-gray-700">
                            Oops, Kategori belum tersedia.
                        </p>
                    @endforelse
                </div>
            </div>

            <!-- Dot navigation -->
            <div class="flex justify-center mt-4 space-x-2">
                <template x-for="i in Math.ceil(totalItems / itemsPerView)" :key="i">
                    <button @click="goTo(i - 1)" aria-label="Dot Button"
                        :class="{ 'bg-blue-500': currentIndex === i - 1, 'bg-gray-300': currentIndex !== i - 1 }"
                        class="w-3 h-3 rounded-full cursor-pointer"></button>
                </template>
            </div>
        </div>
    </section>

    {{-- Bagian Produk --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <h2 class="mb-5 text-xl font-bold">Produk Terlaris</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @forelse ($products as $product)
                    <div class="w-full flex flex-col border border-gray-300 rounded-lg shadow overflow-hidden">
                        <a href="{{ route('product.show', $product->slug) }}" class="flex-1 bg-white">
                            <img src="{{ $product->primaryImage?->image_path ? asset('storage/' . $product->primaryImage->image_path) : asset('img/placeholder-image.webp') }}"
                                alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                                class="w-full aspect-video object-cover" />
                            <div class="px-4 py-2">
                                <h3 class="mb-1 leading-tight line-clamp-2">{{ $product->name }}</h3>
                                <p class="mb-2 text-gray-500 text-xs line-clamp-1">{{ $product->category->name }}</p>
                                <span
                                    class="px-2 py-1 bg-yellow-500/30 text-xs whitespace-nowrap border border-yellow-500 rounded-lg">
                                    ⭐ {{ $product->averageRating() ?? 0 }}
                                </span>
                            </div>
                        </a>
                        <div class="flex items-center justify-between px-4 py-2 bg-gray-200">
                            <span class="font-medium">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                            @php
                                $isWishlisted = auth()->check() && auth()->user()->wishlist->contains($product->id);
                            @endphp

                            <div x-data="{
                                isWishlisted: {{ $isWishlisted ? 'true' : 'false' }},
                                isLoggedIn: {{ auth()->check() ? 'true' : 'false' }}, // cek login
                                toggleWishlist() {
                                    if (!this.isLoggedIn) {
                                        window.location.href = '{{ route('login') }}'; // redirect kalau belum login
                                        return;
                                    }

                                    fetch(this.isWishlisted ?
                                            '{{ route('wishlist.destroy', $product->id) }}' :
                                            '{{ route('wishlist.store', $product->id) }}', {
                                                method: this.isWishlisted ? 'DELETE' : 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                    'Accept': 'application/json',
                                                },
                                            })
                                        .then(res => {
                                            if (res.ok) this.isWishlisted = !this.isWishlisted;
                                            else if (res.status === 401) window.location.href = '{{ route('login') }}'; // fallback
                                        })
                                        .catch(err => console.error(err));
                                }
                            }" class="inline-flex items-center">
                                <button @click.prevent="toggleWishlist" aria-label="Toggle Wishlist"
                                    class="cursor-pointer transition-colors duration-200"
                                    :class="isWishlisted ? 'text-red-500' : 'text-gray-500 hover:text-red-500'">

                                    <template x-if="isWishlisted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15C-7.534 4.736 3.562-3.248 8 1.314z" />
                                        </svg>
                                    </template>

                                    <template x-if="!isWishlisted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path
                                                d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01z" />
                                        </svg>
                                    </template>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 md:col-span-4 lg:col-span-5 text-center py-10">
                        <p class="text-lg font-semibold text-gray-700">
                            Oops, produk belum tersedia.
                        </p>
                        <p class="text-gray-500 mt-1">
                            Ayo dukung UMKM dan cek kategori lainnya!
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-layout>
