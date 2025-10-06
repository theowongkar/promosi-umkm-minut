<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">{{ $product->name }}</x-slot>

    {{-- Bagian Lihat Produk --}}
    <section>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Gambar dan Deskripsi --}}
                <div class="md:col-span-2" x-data="{ activeImage: '{{ $product->primaryImage?->image_path ? asset('storage/' . $product->primaryImage->image_path) : asset('img/placeholder-image.webp') }}' }">
                    <div
                        class="flex justify-center items-center w-full h-56 md:h-72 mx-auto bg-gray-100 border border-gray-300 rounded-lg overflow-hidden mb-3">
                        <img :src="activeImage"
                            alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                            class="object-cover h-full aspect-square transition-all duration-300">
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @foreach ($product->images as $productImage)
                            @php
                                $imagePath = $productImage->image_path
                                    ? asset('storage/' . $productImage->image_path)
                                    : asset('img/placeholder-image.webp');
                            @endphp
                            <div class="flex-shrink-0 w-20 h-20 cursor-pointer border border-gray-300 rounded-lg overflow-hidden"
                                @click="activeImage = '{{ $imagePath }}'">
                                <img src="{{ $imagePath }}"
                                    alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Bagian Utama --}}
                <div>
                    <div class="mb-5 space-y-4">
                        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
                        <div class="flex flex-col space-y-2">
                            <span class="text-xl font-medium">Rp.
                                {{ number_format($product->price, 0, ',', '.') }}</span>
                            <div class="flex items-center gap-2">
                                <span
                                    class="inline-block w-fit px-2 py-1 bg-yellow-500/30 text-sm border border-yellow-500 rounded-lg">
                                    ⭐ {{ number_format($product->averageRating() ?? 0, 1) }}
                                </span>
                                <span class="text-sm text-gray-800">
                                    {{ $product->reviews->count() }} Ulasan
                                </span>
                            </div>
                            <span
                                class="inline-block w-fit px-2 py-1 bg-[#c5e1a5] text-sm border border-green-500 rounded-md">{{ $product->category->name }}</span>
                        </div>
                        <p>{{ $product->description }}</p>
                    </div>

                    <div class="space-y-2">
                        <a href="https://wa.me/{{ $product->business->owner_phone }}" target="_blank"
                            class="inline-flex items-center gap-x-2 px-2 py-1 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-telephone-outbound-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5" />
                            </svg>
                            Hubungi
                        </a>

                        @php
                            $isWishlisted = auth()->check() && auth()->user()->wishlist->contains($product->id);
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
                        }">
                            <button @click.prevent="toggleWishlist"
                                class="inline-flex items-center gap-2 px-2 py-1 border border-gray-300 rounded-lg cursor-pointer transition-colors"
                                :class="isWishlisted ? 'bg-red-100 border-red-300 text-red-600 hover:bg-red-200' :
                                    'hover:bg-gray-100'">
                                <template x-if="!isWishlisted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01z" />
                                    </svg>
                                </template>
                                <template x-if="isWishlisted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart-fill text-red-600" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                    </svg>
                                </template>
                                <span x-text="isWishlisted ? 'Di Wishlist' : 'Wishlist'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi & Ulasan --}}
                <div class="md:col-span-2">
                    <div class="border-2 border-[#c5e1a5] rounded-lg shadow" x-data="{ tab: 'deskripsi' }">

                        {{-- Tabs --}}
                        <div class="flex justify-evenly py-2 border-b-2 border-[#c5e1a5]">
                            <button type="button" class="font-semibold cursor-pointer px-4 py-2 border-b-2"
                                :class="tab === 'deskripsi' ? 'border-b-[#c5e1a5]' : 'border-transparent'"
                                @click="tab = 'deskripsi'">
                                Deskripsi
                            </button>
                            <button type="button" class="font-semibold cursor-pointer px-4 py-2 border-b-2"
                                :class="tab === 'ulasan' ? 'border-b-[#c5e1a5]' : 'border-transparent'"
                                @click="tab = 'ulasan'">
                                Ulasan
                            </button>
                        </div>

                        {{-- Konten --}}
                        <div class="p-5">
                            <div x-cloak x-show="tab === 'deskripsi'" x-transition>
                                <p>{{ $product->description }}</p>
                            </div>

                            <div x-cloak x-show="tab === 'ulasan'" x-transition>
                                <ul class="space-y-4">
                                    <li>
                                        <x-alerts.flash-message />

                                        @php
                                            $userReview = auth()->check()
                                                ? $product->reviews->where('user_id', auth()->id())->first()
                                                : null;
                                        @endphp

                                        <form action="{{ route('product-review.upsert', $product) }}" method="POST"
                                            class="space-y-2">
                                            @csrf

                                            <x-forms.select label="Rating" name="rating" :options="[
                                                1 => '1 - Kurang',
                                                2 => '2 - Cukup',
                                                3 => '3 - Baik',
                                                4 => '4 - Sangat Baik',
                                                5 => '5 - Sangat Memuaskan',
                                            ]"
                                                :selected="old('rating', optional($userReview)->rating)" />

                                            <x-forms.textarea label="Ulasan" name="comment" :value="old('comment', optional($userReview)->comment)" />

                                            <x-buttons.primary-button type="submit" class="w-full">
                                                {{ $userReview ? 'Ubah' : 'Simpan' }}
                                            </x-buttons.primary-button>
                                        </form>
                                    </li>
                                    @forelse ($product->reviews as $review)
                                        <li class="border-b pb-2">
                                            <span
                                                class="inline-block px-2 py-1 bg-yellow-500/30 text-xs whitespace-nowrap border border-yellow-500 rounded-lg">
                                                ⭐ {{ $review->rating }}
                                            </span>
                                            <p class="font-semibold">{{ $review->user->name }}</p>
                                            <time
                                                class="text-gray-700">{{ $review->created_at->diffForhumans() }}</time>
                                            <p class="mt-1">{{ $review->comment }}</p>
                                        </li>
                                    @empty
                                        <p>Belum ada ulasan.</p>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
