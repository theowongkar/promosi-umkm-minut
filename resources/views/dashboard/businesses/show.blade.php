<x-app-layout>

    <x-slot name="title">Detail Usaha</x-slot>

    <section>
        <div class="bg-white border border-gray-300 rounded-lg shadow">
            <div class="p-4 lg:p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Image --}}
                <div class="col-span-1">
                    <div class="w-full h-56 overflow-hidden rounded-md border shadow-sm">
                        <img src="{{ $business->image_path ? asset('storage/' . $business->image_path) : asset('img/placeholder-image.webp') }}"
                            alt="{{ $business->name }}" class="w-full h-full object-cover" />
                    </div>


                    <div class="mt-3 space-y-2">
                        <div>
                            <h4 class="text-xs text-gray-500">Data User</h4>
                            <div class="font-medium">{{ $business->owner->name }}</div>
                        </div>

                        <div>
                            <h4 class="text-xs text-gray-500">Kontak</h4>
                            <div class="text-gray-700">{{ $business->owner->email ?? '-' }}</div>
                        </div>

                        <div>
                            <h4 class="text-xs text-gray-500">Email</h4>
                            <div class="text-gray-700">{{ $business->owner->status ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                {{-- Middle: Details --}}
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold">{{ $business->name }}</h2>
                            <div class="text-sm text-gray-500 space-x-2">
                                <span
                                    class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">{{ optional($business->category)->name }}</span>
                                <span
                                    class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">{{ $business->business_type }}</span>
                            </div>
                        </div>

                        <div class="text-right text-sm text-gray-500">
                            Dibuat: {{ \Carbon\Carbon::parse($business->created_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-xs text-gray-500">Informasi Pemilik</h4>
                            <div class="text-gray-700">Nama: {{ $business->owner_name }}</div>
                            <div class="text-gray-700">NIK: {{ $business->owner_nik ?? '-' }}</div>
                            <div class="text-gray-700">Telepon: {{ $business->owner_phone ?? '-' }}</div>
                        </div>

                        <div>
                            <h4 class="text-xs text-gray-500">Alamat Lengkap</h4>
                            <div class="text-gray-700">{{ $business->address ?? '-' }}</div>
                            <div class="text-gray-700 mt-1">
                                {{ $business->village }}, {{ $business->district }}, {{ $business->city }},
                                {{ $business->province }}</div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-sm font-medium">Produk ({{ $business->products->count() }})</h4>
                        @if ($business->products->isNotEmpty())
                            <ul class="mt-2 ml-4 list-disc list-outside text-gray-700">
                                @foreach ($business->products as $product)
                                    <li>
                                        <a href="{{ route('dashboard.product.edit', $product->slug) }}"
                                            class="text-blue-600 line-clamp-2 hover:underline">{{ $product->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-gray-500 mt-2">Belum ada produk.</div>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-2">
                        <x-buttons.primary-button href="{{ route('dashboard.business.index') }}"
                            class="bg-gray-600 hover:bg-gray-700">Kembali</x-buttons.primary-button>
                        <form action="{{ route('dashboard.business.destroy', $business->slug) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus usaha ini?')">
                            @csrf
                            @method('DELETE')
                            <x-buttons.primary-button type="submit"
                                class="bg-red-600 hover:bg-red-700">Hapus</x-buttons.primary-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
