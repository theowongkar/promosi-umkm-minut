<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Produk</x-slot>

    {{-- Bagian Produk --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <div class="flex flex-col md:flex-row gap-5">
                <div class="w-60">
                    <h2 class="mb-5 text-xl font-bold">Filter</h2>
                    <h3 class="mb-2 font-medium">Kategori Produk</h3>
                    <form action="{{ route('product.index') }}" method="GET">
                        <ul class="space-y-3">
                            <li class="flex items-center gap-x-2">
                                <input type="radio" name="category" id="cat-all" value=""
                                    {{ request('category') == null ? 'checked' : '' }} onchange="this.form.submit()">
                                <label for="cat-all" class="text-xs text-gray-800">
                                    Semua Kategori
                                </label>
                            </li>

                            @foreach ($productCategories as $productCategory)
                                <li class="flex items-center gap-x-2">
                                    <input type="radio" name="category" id="cat-{{ $productCategory->id }}"
                                        value="{{ $productCategory->slug }}"
                                        {{ request('category') == $productCategory->slug ? 'checked' : '' }}
                                        onchange="this.form.submit()">
                                    <label for="cat-{{ $productCategory->id }}" class="text-xs text-gray-800">
                                        {{ $productCategory->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                </div>

                <div class="md:flex-1">
                    <h2 class="mb-5 text-xl font-bold">Produk Terkait</h2>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        @forelse ($products as $product)
                            <div class="w-full flex flex-col border border-gray-300 rounded-lg shadow overflow-hidden">
                                <a href="{{ route('product.show', $product->slug) }}" class="flex-1 bg-white">
                                    <img src="{{ $product->primaryImage?->image_path ? asset('storage/' . $product->primaryImage->image_path) : asset('img/placeholder-image.webp') }}"
                                        alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                                        class="w-full aspect-video object-cover" />
                                    <div class="px-4 py-2">
                                        <h3 class="mb-1 leading-tight line-clamp-2">{{ $product->name }}</h3>
                                        <p class="mb-2 text-gray-500 text-xs line-clamp-1">
                                            {{ $product->category->name }}
                                        </p>
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
                                        $isWishlisted =
                                            auth()->check() && auth()->user()->wishlist->contains($product->id);
                                    @endphp

                                    <div x-data="{
                                        isWishlisted: {{ $isWishlisted ? 'true' : 'false' }},
                                        isLoggedIn: {{ auth()->check() ? 'true' : 'false' }},
                                        toggleWishlist() {
                                            if (!this.isLoggedIn) {
                                                window.location.href = '{{ route('login') }}';
                                                return;
                                            }
                                    
                                            fetch(this.isWishlisted ?
                                                    '{{ route('product-wishlist.destroy', $product->id) }}' :
                                                    '{{ route('product-wishlist.store', $product->id) }}', {
                                                        method: this.isWishlisted ? 'DELETE' : 'POST',
                                                        headers: {
                                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                            'Accept': 'application/json',
                                                        },
                                                    })
                                                .then(res => {
                                                    if (res.ok) this.isWishlisted = !this.isWishlisted;
                                                    else if (res.status === 401) window.location.href = '{{ route('login') }}';
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

                    <div class="mt-5">
                        {{ $products->withQueryString()->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
