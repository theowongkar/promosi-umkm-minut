<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Data User</x-slot>

    {{-- Bagian User --}}
    <section class="space-y-2">

        {{-- Header --}}
        <div class="bg-gray-50 rounded-lg border border-gray-300 shadow">
            <div class="p-2 space-y-2">
                {{-- Modal Create --}}
                <div x-data="{ openCreate: false }" class="flex flex-col lg:flex-row items-center justify-between gap-4">
                    {{-- Tombol Tambah --}}
                    <x-buttons.primary-button href="{{ route('dashboard.user.create') }}"
                        class="w-full lg:w-auto text-center bg-green-600 hover:bg-green-700">
                        Tambah
                    </x-buttons.primary-button>

                    {{-- Form Filter & Search --}}
                    <form method="GET" action="{{ route('dashboard.user.index') }}"
                        class="w-full flex justify-end gap-1" x-data="{ openFilter: '' }">

                        {{-- Filter: Role --}}
                        <div class="relative">
                            <button type="button"
                                @click="requestAnimationFrame(() => openFilter = openFilter === 'role' ? '' : 'role')"
                                class="cursor-pointer bg-white border border-gray-300 rounded-md p-2 hover:ring-1 hover:ring-blue-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-gender-ambiguous size-5" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z" />
                                </svg>
                            </button>
                            <div x-show="openFilter === 'role'" @click.away="openFilter = ''" x-transition
                                class="absolute z-10 mt-2 w-44 bg-white border border-gray-300 rounded-md shadow-lg p-3">
                                <label class="block text-xs text-gray-500 mb-1">Role</label>
                                <select name="role" x-on:change="$root.submit()"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" {{ request('role') == '' ? 'selected' : '' }}>Semua</option>
                                    <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="Penjual" {{ request('role') == 'Penjual' ? 'selected' : '' }}>Penjual
                                    </option>
                                    <option value="Pengunjung" {{ request('role') == 'Pengunjung' ? 'selected' : '' }}>
                                        Pengunjung</option>
                                </select>
                            </div>
                        </div>

                        {{-- Filter: Status --}}
                        <div class="relative">
                            <button type="button"
                                @click="requestAnimationFrame(() => openFilter = openFilter === 'status' ? '' : 'status')"
                                class="cursor-pointer bg-white border border-gray-300 rounded-md p-2 hover:ring-1 hover:ring-blue-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-file-earmark-medical size-5" viewBox="0 0 16 16">
                                    <path
                                        d="M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                </svg>
                            </button>
                            <div x-show="openFilter === 'status'" @click.away="openFilter = ''" x-transition
                                class="absolute z-10 mt-2 w-44 bg-white border border-gray-300 rounded-md shadow-lg p-3">
                                <label class="block text-xs text-gray-500 mb-1">Status</label>
                                <select name="status" x-on:change="$root.submit()"
                                    class="block w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua
                                    </option>
                                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Tidak Aktif"
                                        {{ request('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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
                            <x-forms.input type="text" name="search" placeholder="Cari nama atau email pengguna..."
                                autocomplete="off" value="{{ request('search') }}"
                                x-on:input.debounce.500ms="$root.submit()"></x-forms.input>
                        </div>
                    </form>
                </div>

                {{-- Pagination --}}
                <div class="overflow-x-auto">
                    {{ $users->withQueryString()->links('pagination::custom') }}
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
                        <th class="p-2 font-normal text-left border-r border-gray-600">Email</th>
                        <th class="p-2 font-normal text-left border-r border-gray-600">Role</th>
                        <th class="p-2 font-normal text-center border-r border-gray-600">Status</th>
                        <th class="p-2 font-normal text-center border-r border-gray-600">Dibuat</th>
                        <th class="p-2 font-normal text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50">
                            <td class="p-2 text-center border-r border-gray-300">
                                {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $user->name }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $user->email }}
                            </td>
                            <td class="p-2 border-r border-gray-300 whitespace-nowrap">{{ $user->role }}
                            </td>
                            <td class="p-2 text-center border-r border-gray-300">
                                @php
                                    $status = $user->status;
                                    $colors = [
                                        'Aktif' => 'bg-green-200 text-green-800 border border-green-400',
                                        'Tidak Aktif' => 'bg-red-200 text-red-800 border border-red-400',
                                    ];
                                @endphp

                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium whitespace-nowrap {{ $colors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="p-2 text-center border-r border-gray-300 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="p-2 whitespace-nowrap">
                                <div class="flex justify-center items-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('dashboard.user.edit', $user->id) }}"
                                        class="text-yellow-600 hover:underline text-sm cursor-pointer">
                                        Edit
                                    </a>

                                    <form action="{{ route('dashboard.user.destroy', $user->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                            <td colspan="7" class="p-4 text-center text-gray-500">Tidak ada data user
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</x-app-layout>
