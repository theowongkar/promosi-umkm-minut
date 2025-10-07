<x-guest-layout>
    <x-slot name="title">Tambah Produk — {{ $business->name }}</x-slot>

    <section>
        {{-- Flash Message --}}
        <x-alerts.flash-message />

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <h2 class="mb-6 text-xl font-bold">Tambah Produk untuk {{ $business->name }}</h2>

            <form action="{{ route('my-product.store', $business->slug) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-forms.select label="Kategori Produk" name="product_category_id" :options="$productCategories->pluck('name', 'id')" />

                    <x-forms.input type="text" label="Nama Produk" name="name" value="{{ old('name') }}" />

                    <x-forms.input type="number" step="0.01" label="Harga" name="price"
                        value="{{ old('price') }}" />
                </div>

                <x-forms.textarea label="Deskripsi" name="description"
                    rows="5">{{ old('description') }}</x-forms.textarea>

                {{-- Upload Gambar --}}
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Gambar Produk</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                        class="w-full px-3 py-2 text-sm bg-white border rounded-md
                               focus:outline-none focus:ring-1 border-gray-300
                               focus:ring-blue-500 focus:border-blue-500">

                    @error('images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @foreach ($errors->get('images.*') as $messages)
                        @foreach ($messages as $message)
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @endforeach
                    @endforeach
                </div>

                <div class="pt-4">
                    <x-buttons.primary-button href="{{ route('my-business.index') }}"
                        class="mr-1 bg-gray-600 hover:bg-gray-700">Kembali</x-buttons.primary-button>
                    <x-buttons.primary-button type="submit">Simpan Produk</x-buttons.primary-button>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
