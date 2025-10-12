<x-app-layout>

    <x-slot name="title">Detail Produk — {{ Str::limit($product->name, 50) }}</x-slot>

    <section class="space-y-4">
        {{-- Breadcrumbs / Header --}}
        <div>
            <h1 class="text-2xl font-bold mt-2">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 mt-1">{{ optional($product->business)->name ?? '—' }} ·
                {{ optional($product->category)->name ?? 'Umum' }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left: Images --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                    <div x-data="{ activeImage: '{{ $product->primaryImage?->image_path ? asset('storage/' . $product->primaryImage->image_path) : asset('img/placeholder-image.webp') }}' }">
                        <div
                            class="flex justify-center items-center w-full h-56 md:h-72 mx-auto bg-gray-100 border border-gray-300 rounded-lg overflow-hidden mb-3">
                            <img :src="activeImage"
                                alt="{{ implode(' ', array_slice(explode(' ', $product->name), 0, 2)) }}"
                                class="object-cover h-full aspect-square transition-all duration-300">
                        </div>
                        <div class="flex gap-2 overflow-x-auto pb-2 px-3">
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
                </div>
            </div>

            {{-- Middle: Details --}}
            <div class="lg:col-span-2 space-y-4">
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-lg font-semibold">Informasi Produk</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ Str::limit($product->description ?? '—', 250) }}
                            </p>
                        </div>

                        <div class="text-right">
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium whitespace-nowrap {{ $product->status == 'Diterima' ? 'bg-green-200 text-green-800' : ($product->status == 'Ditolak' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">
                                {{ $product->status }}</div>
                            <div class="text-sm text-gray-400 mt-2">Dibuat:
                                {{ \Carbon\Carbon::parse($product->created_at)->translatedFormat('d M Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mt-4">
                        <div class="text-sm text-gray-600">Kategori<br><span
                                class="font-medium">{{ optional($product->category)->name ?? '—' }}</span></div>
                        <div class="text-sm text-gray-600">Toko<br><span
                                class="font-medium">{{ optional($product->business)->name ?? '—' }}</span></div>
                        <div class="text-sm text-gray-600">Harga<br><span class="font-medium">Rp
                                {{ number_format($product->price ?? 0, 0, ',', '.') }}</span></div>
                    </div>
                </div>

                {{-- Status form card --}}
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                    <h3 class="font-semibold mb-2">Ubah Status Produk</h3>
                    <form action="{{ route('dashboard.product.update', $product->slug) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                            <div>
                                <label class="block text-sm text-gray-500 mb-1">Status</label>
                                <select name="status" class="block w-full px-3 py-2 border border-gray-300 rounded">
                                    <option value="Menunggu Persetujuan"
                                        {{ $product->status == 'Menunggu Persetujuan' ? 'selected' : '' }}>Menunggu
                                        Persetujuan</option>
                                    <option value="Diterima" {{ $product->status == 'Diterima' ? 'selected' : '' }}>
                                        Diterima</option>
                                    <option value="Ditolak" {{ $product->status == 'Ditolak' ? 'selected' : '' }}>
                                        Ditolak</option>
                                </select>
                            </div>

                            <div class="md:col-span-2 flex gap-2">
                                <x-buttons.primary-button type="submit">Simpan Status</x-buttons.primary-button>
                                <a href="{{ route('dashboard.product.index') }}"
                                    class="inline-flex items-center px-3 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
