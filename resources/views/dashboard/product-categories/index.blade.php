<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Data Kategori Produk</x-slot>

    {{-- Bagian Kategori Produk --}}
    <section class="space-y-2">

        {{-- Header --}}
        <div class="bg-gray-50 rounded-lg border border-gray-300 shadow">
            <div class="p-2 space-y-2">
                {{-- Modal Create --}}
                <div x-data="{ openCreate: false }" class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    {{-- Tombol Tambah --}}
                    <x-buttons.primary-button @click="openCreate = true"
                        class="w-full lg:w-auto text-center bg-green-600 hover:bg-green-700">
                        Tambah
                    </x-buttons.primary-button>

                    {{-- Modal Create Kategori Produk --}}
                    <div x-show="openCreate" class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">
                        <div class="bg-white rounded-lg p-6 w-full max-w-lg max-h-[80vh] overflow-y-auto">
                            <h2 class="text-lg font-semibold mb-4">Tambah Kategori Produk</h2>

                            <form method="POST" action="{{ route('dashboard.product-category.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="grid grid-cols-1 gap-5">
                                    <x-forms.input name="name" label="Nama Kategori" required></x-forms.input>

                                    {{-- Upload Gambar --}}
                                    <x-forms.input type="file" name="image_path" label="Gambar Kategori"
                                        accept="image/*"></x-forms.input>
                                </div>

                                <div class="mt-3 flex justify-end gap-2">
                                    <x-buttons.primary-button @click="openCreate = false" type="button"
                                        class="bg-gray-600 hover:bg-gray-700">
                                        Batal
                                    </x-buttons.primary-button>
                                    <x-buttons.primary-button type="submit" class="bg-green-600 hover:bg-green-700">
                                        Simpan
                                    </x-buttons.primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Form Filter & Search --}}
                    <form method="GET" action="#" class="w-full flex justify-end gap-1" x-data="{ openFilter: '' }">
                        {{-- ... (filter tanggal & search tetap sama) --}}
                    </form>
                </div>

                {{-- Pagination --}}
                <div class="overflow-x-auto">
                    {{ $productCategories->withQueryString()->links('pagination::custom') }}
                </div>
            </div>
        </div>

        {{-- Flash Message --}}
        <x-alerts.flash-message />

        {{-- Table --}}
        <div class="bg-white rounded-lg border border-gray-300 shadow overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-[#3e2723] text-gray-50">
                    <tr>
                        <th class="p-2 font-normal text-center border-r border-gray-600">#</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Nama</th>
                        <th class="p-2 font-normal text-center border-r border-gray-600">Gambar</th>
                        <th class="p-2 font-normal text-center border-r border-gray-600">Dibuat</th>
                        <th class="p-2 font-normal text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @forelse($productCategories as $productCategory)
                        <tr class="hover:bg-blue-50">
                            <td class="p-2 text-center border-r border-gray-300">
                                {{ ($productCategories->currentPage() - 1) * $productCategories->perPage() + $loop->iteration }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $productCategory->name }}</td>

                            {{-- Tampilkan Gambar --}}
                            <td class="p-2 text-center border-r border-gray-300">
                                @if ($productCategory->image_path)
                                    <img src="{{ asset('storage/' . $productCategory->image_path) }}"
                                        alt="Gambar {{ $productCategory->name }}"
                                        class="w-12 h-12 object-cover rounded mx-auto">
                                @else
                                    <span class="text-gray-400 text-xs italic">Tidak ada</span>
                                @endif
                            </td>

                            <td class="p-2 text-center border-r border-gray-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($productCategory->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    <div x-data="{ openEdit: false }">
                                        {{-- Tombol Edit --}}
                                        <a @click="openEdit = true"
                                            class="text-yellow-600 hover:underline text-sm cursor-pointer">
                                            Edit
                                        </a>

                                        {{-- Modal Edit Kategori Produk --}}
                                        <div x-show="openEdit"
                                            class="fixed inset-0 flex items-center justify-center bg-black/50 z-50">

                                            <div
                                                class="bg-white rounded-lg p-6 w-full max-w-lg max-h-[80vh] overflow-y-auto">
                                                <h2 class="text-lg font-semibold mb-4">Edit Kategori Produk</h2>

                                                <form method="POST"
                                                    action="{{ route('dashboard.product-category.update', $productCategory->slug) }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="grid grid-cols-1 gap-5">
                                                        <x-forms.input name="name" label="Nama Kategori"
                                                            :value="old('name', $productCategory->name)" required></x-forms.input>

                                                        {{-- Upload Gambar --}}
                                                        <x-forms.input type="file" name="image_path"
                                                            label="Ganti Gambar (Opsional)"
                                                            accept="image/*"></x-forms.input>

                                                        {{-- Preview gambar lama --}}
                                                        @if ($productCategory->image_path)
                                                            <div>
                                                                <label class="text-xs text-gray-500 mb-1 block">Gambar
                                                                    Saat Ini:</label>
                                                                <img src="{{ asset('storage/' . $productCategory->image_path) }}"
                                                                    alt="Gambar {{ $productCategory->name }}"
                                                                    class="w-20 h-20 object-cover rounded border">
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="mt-3 flex justify-end gap-2">
                                                        <x-buttons.primary-button @click="openEdit = false"
                                                            type="button" class="bg-gray-600 hover:bg-gray-700">
                                                            Batal
                                                        </x-buttons.primary-button>
                                                        <x-buttons.primary-button type="submit"
                                                            class="bg-green-600 hover:bg-green-700">
                                                            Update
                                                        </x-buttons.primary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Tombol Hapus --}}
                                    <form
                                        action="{{ route('dashboard.product-category.destroy', $productCategory->slug) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="text-red-600 hover:underline text-sm cursor-pointer">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">Tidak ada data kategori produk</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</x-app-layout>
