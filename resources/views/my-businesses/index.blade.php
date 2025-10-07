<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Usaha Saya</x-slot>

    {{-- Bagian Usaha Saya --}}
    <section>
        {{-- Flash Message --}}
        <x-alerts.flash-message />

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            {{-- Card Title --}}
            <h2 class="mb-2 text-xl font-bold">Usaha Saya</h2>

            {{-- Tambah Usaha --}}
            <div class="flex justify-end mb-5">
                <x-buttons.primary-button href="{{ route('my-business.create') }}"
                    class="bg-green-600 font-bold hover:bg-green-700">🏪 Tambah Usaha</x-buttons.primary-button>
            </div>

            {{-- Konten Utama --}}
            <div class="space-y-10">
                @forelse ($businesses as $business)
                    <div class="w-full border border-gray-300 rounded-lg shadow overflow-hidden">
                        {{-- Data Usaha --}}
                        <div class="px-4 py-3">
                            <div class="flex items-start justify-between">
                                <h3 class="text-xl font-semibold leading-tight">{{ $business->name }}</h3>
                                <a href="{{ route('my-business.edit', $business->slug) }}"
                                    class="text-blue-600 whitespace-nowrap hover:underline cursor-pointer">Lihat
                                    detail</a>
                            </div>
                            <p class="mb-1 text-gray-500 text-sm">{{ $business->category->name }} &bull;
                                {{ $business->business_type }} &bull; {{ $business->owner_name }}</p>
                            <p class="text-sm">{{ $business->address }}, {{ $business->village }},
                                {{ $business->district }},
                                {{ $business->city }}</p>
                        </div>

                        {{-- Detail Produk --}}
                        <div class="px-4 py-3 border-t">
                            <div class="flex justify-end mb-2">
                                <x-buttons.primary-button href="{{ route('my-product.create', $business->slug) }}"
                                    class="bg-blue-600 hover:bg-blue-700">📦 Tambah
                                    Produk</x-buttons.primary-button>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                                @forelse ($business->products as $product)
                                    <div
                                        class="w-full flex flex-col border border-gray-300 rounded-lg shadow overflow-hidden">
                                        <a href="{{ route('my-product.edit', [$business->slug, $product->slug]) }}"
                                            class="flex-1 bg-white">
                                            <img src="{{ $product->primaryImage?->image_path ? asset('storage/' . $product->primaryImage->image_path) : asset('img/placeholder-image.webp') }}"
                                                alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                                                class="w-full aspect-video object-cover" />
                                            <div class="px-4 py-2">
                                                @php
                                                    switch ($product->status) {
                                                        case 'Diterima':
                                                            $badgeColor =
                                                                'bg-green-100 text-green-700 border border-green-500';
                                                            break;
                                                        case 'Menunggu Persetujuan':
                                                            $badgeColor =
                                                                'bg-yellow-100 text-yellow-700 border border-yellow-500';
                                                            break;
                                                        case 'Ditolak':
                                                            $badgeColor =
                                                                'bg-red-100 text-red-700 border border-red-500';
                                                            break;
                                                        default:
                                                            $badgeColor =
                                                                'bg-gray-100 text-gray-700 border border-gray-500';
                                                    }
                                                @endphp

                                                <span
                                                    class="inline-block mb-2 px-2 py-0.5 text-sm rounded {{ $badgeColor }}">
                                                    {{ $product->status }}
                                                </span>
                                                <h3 class="mb-1 leading-tight line-clamp-2">{{ $product->name }}</h3>
                                                <p class="mb-2 text-gray-500 text-xs line-clamp-1">
                                                    {{ $product->category->name }}</p>
                                                <span
                                                    class="px-2 py-1 bg-yellow-500/30 text-xs whitespace-nowrap border border-yellow-500 rounded-lg">
                                                    ⭐ {{ $product->averageRating() ?? 0 }}
                                                </span>
                                            </div>
                                        </a>
                                        <div class="px-4 py-2 bg-gray-200">
                                            <span class="font-medium">Rp.
                                                {{ number_format($product->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-5">
                                        <p>Kamu belum memiliki produk apapun.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div>
                        <p>Kamu belum memiliki usaha apapun.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

</x-guest-layout>
