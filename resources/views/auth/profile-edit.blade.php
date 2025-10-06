<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Edit Profil</x-slot>

    {{-- Bagian Banner --}}
    <section>
        <x-alerts.flash-message />
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <div class="flex justify-center">
                <div class="w-full max-w-sm flex flex-col p-5 border border-gray-300 rounded-lg shadow overflow-hidden">
                    <h1 class="mb-5 text-xl font-bold">Edit Profil</h1>

                    <form action="{{ route('profile.update') }}" method="post" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <x-forms.input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            placeholder="Username" />
                        <x-forms.input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            placeholder="Email" />
                        <x-forms.select name="role" :options="['Pengunjung', 'Penjual']" :selected="old('role', auth()->user()->role)" />
                        <div class="flex items-center mt-5 mb-3">
                            <div class="flex-grow border-t border-gray-300"></div>
                            <span class="px-3 text-sm text-gray-500">Kosongkan jika tidak merubah password</span>
                            <div class="flex-grow border-t border-gray-300"></div>
                        </div>
                        <x-forms.input type="password" name="password" placeholder="Password" />
                        <x-forms.input type="password" name="password_confirmation" placeholder="Konfirmasi Password" />

                        <x-buttons.primary-button type="submit" class="w-full">Simpan</x-buttons.primary-button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
