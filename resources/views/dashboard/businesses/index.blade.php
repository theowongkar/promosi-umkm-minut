<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Data Usaha</x-slot>

    {{-- Bagian Usaha --}}
    <section class="space-y-2">

        {{-- Header --}}
        <div class="bg-gray-50 rounded-lg border border-gray-300 shadow">
            <div class="p-2 space-y-2">
                {{-- Modal Create --}}
                <div x-data="{ openCreate: false }" class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    {{-- Tombol Tambah --}}
                    <x-buttons.primary-button href="{{ route('dashboard.business.pdf') }}" target="_blank"
                        class="w-full lg:w-auto text-center">
                        Cetak
                    </x-buttons.primary-button>

                    {{-- Form Filter & Search --}}
                    <form method="GET" action="{{ route('dashboard.business.index') }}"
                        class="w-full flex justify-end gap-1" x-data="{ openFilter: '' }">

                        {{-- Filter: Tipe Usaha --}}
                        <div class="relative">
                            <button type="button"
                                @click="requestAnimationFrame(() => openFilter = openFilter === 'business_type' ? '' : 'business_type')"
                                class="cursor-pointer bg-white border border-gray-300 rounded-md p-2 hover:ring-1 hover:ring-blue-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-building-exclamation size-5" viewBox="0 0 16 16">
                                    <path
                                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6.5a.5.5 0 0 1-1 0V1H3v14h3v-2.5a.5.5 0 0 1 .5-.5H8v4H3a1 1 0 0 1-1-1z" />
                                    <path
                                        d="M4.5 2a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-6 3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm3 0a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm8.5 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5m0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                </svg>
                            </button>
                            <div x-show="openFilter === 'business_type'" @click.away="openFilter = ''" x-transition
                                class="absolute z-10 mt-2 w-44 bg-white border border-gray-300 rounded-md shadow-lg p-3">
                                <label class="block text-xs text-gray-500 mb-1">Tipe Usaha</label>
                                <select name="business_type" x-on:change="$root.submit()"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" {{ request('business_type') == '' ? 'selected' : '' }}>Semua
                                    </option>
                                    <option value="Mikro" {{ request('business_type') == 'Mikro' ? 'selected' : '' }}>
                                        Mikro
                                    </option>
                                    <option value="Kecil" {{ request('business_type') == 'Kecil' ? 'selected' : '' }}>
                                        Kecil
                                    </option>
                                    <option value="Menengah"
                                        {{ request('business_type') == 'Menengah' ? 'selected' : '' }}>
                                        Menengah</option>
                                </select>
                            </div>
                        </div>

                        {{-- Filter: Tanggal Mulai --}}
                        <div class="relative">
                            <button type="button"
                                @click="requestAnimationFrame(() => openFilter = openFilter === 'start_date' ? '' : 'start_date')"
                                class="cursor-pointer bg-white border border-gray-300 rounded-md p-2 hover:ring-1 hover:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-calendar-check size-5" viewBox="0 0 16 16">
                                    <path
                                        d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg>
                            </button>
                            <div x-show="openFilter === 'start_date'" @click.away="openFilter = ''" x-transition
                                class="absolute z-10 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg p-3">
                                <label class="block text-xs text-gray-500 mb-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" value="{{ request('start_date') }}"
                                    x-on:input.debounce.500ms="$root.submit()"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>

                        {{-- Filter: Tanggal Selesai --}}
                        <div class="relative">
                            <button type="button"
                                @click="requestAnimationFrame(() => openFilter = openFilter === 'end_date' ? '' : 'end_date')"
                                class="cursor-pointer bg-white border border-gray-300 rounded-md p-2 hover:ring-1 hover:ring-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-calendar-x size-5" viewBox="0 0 16 16">
                                    <path
                                        d="M6.146 7.146a.5.5 0 0 1 .708 0L8 8.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 9l1.147 1.146a.5.5 0 0 1-.708.708L8 9.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 9 6.146 7.854a.5.5 0 0 1 0-.708" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg>
                            </button>
                            <div x-show="openFilter === 'end_date'" @click.away="openFilter = ''" x-transition
                                class="absolute z-10 mt-2 w-48 bg-white border border-gray-300 rounded-md shadow-lg p-3">
                                <label class="block text-xs text-gray-500 mb-1">Tanggal Selesai</label>
                                <input type="date" name="end_date" value="{{ request('end_date') }}"
                                    x-on:input.debounce.500ms="$root.submit()"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                            </div>
                        </div>

                        {{-- Input Search --}}
                        <div class="w-full lg:w-80">
                            <x-forms.input type="text" name="search" placeholder="Cari nama atau pemilik usaha..."
                                autocomplete="off" value="{{ request('search') }}"
                                x-on:input.debounce.500ms="$root.submit()"></x-forms.input>
                        </div>
                    </form>
                </div>

                {{-- Pagination --}}
                <div class="overflow-x-auto">
                    {{ $businesses->withQueryString()->links('pagination::custom') }}
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
                        <th class="p-2 font-normal text-left border-r border-gray-600">Pemilik</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">NIK</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Provinsi</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Kota/Kabupaten</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Kecamatan</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Kelurahan/Desa</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Tipe Usaha</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Kategori</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Produk</th>
                        <th class="p-2 font-normal text-center border-r border-gray-600">Dibuat</th>
                        <th class="p-2 font-normal text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @forelse($businesses as $business)
                        <tr class="hover:bg-blue-50">
                            <td class="p-2 text-center border-r border-gray-300">
                                {{ ($businesses->currentPage() - 1) * $businesses->perPage() + $loop->iteration }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->name }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->owner_name }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->owner_nik }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->province }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->city }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->district }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->village }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $business->business_type }}
                            </td>
                            <td class="min-w-xs max-w-xs p-2 border-r border-gray-300">
                                {{ Str::limit($business->category->name, 50) }}
                            </td>
                            <td class="min-w-md max-w-md p-2 border-r border-gray-300">
                                {{ Str::limit($business->products->pluck('name')->implode(', '), 120) }}
                            </td>
                            <td class="p-2 text-center border-r border-gray-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($business->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    {{-- Tombol Lihat --}}
                                    <a href="{{ route('dashboard.business.show', $business->slug) }}"
                                        class="text-blue-600 hover:underline text-sm cursor-pointer">
                                        Lihat
                                    </a>

                                    <form action="{{ route('dashboard.business.destroy', $business->slug) }}"
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
                            <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data usaha
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</x-app-layout>
