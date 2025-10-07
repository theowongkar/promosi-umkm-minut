<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Ubah Produk — {{ $product->name }}</x-slot>

    <section>
        <x-alerts.flash-message />

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <h2 class="mb-6 text-xl font-bold">
                Ubah Produk: {{ $product->name }} — <span class="text-gray-600">{{ $business->name }}</span>
            </h2>

            <form action="{{ route('my-product.update', [$business->slug, $product->slug]) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-forms.select label="Kategori Produk" name="product_category_id" :options="$productCategories->pluck('name', 'id')"
                        :selected="$product->product_category_id" />

                    <x-forms.input type="text" label="Nama Produk" name="name"
                        value="{{ old('name', $product->name) }}" />

                    <x-forms.input type="number" step="0.01" label="Harga" name="price"
                        value="{{ old('price', $product->price) }}" />
                </div>

                <x-forms.textarea label="Deskripsi" name="description" rows="5"
                    value="{{ old('description', $product->description) }}" />

                {{-- Upload gambar baru --}}
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Gambar Baru (opsional)</label>
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

                {{-- Preview gambar lama --}}
                @if ($product->images->count())
                    <div class="flex gap-2 mt-3 flex-wrap">
                        @foreach ($product->images as $image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar produk"
                                    class="w-24 h-24 object-cover rounded-md border shadow">

                                <button type="button"
                                    class="absolute top-0 right-0 bg-red-600 text-white text-xs px-1 rounded-bl opacity-0 group-hover:opacity-100 transition">
                                    Hapus
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="pt-4">
                    <x-buttons.primary-button href="{{ route('my-business.index') }}"
                        class="mr-1 bg-gray-600 hover:bg-gray-700">Kembali</x-buttons.primary-button>
                    <x-buttons.primary-button type="submit">Perbarui Produk</x-buttons.primary-button>
                    <x-buttons.primary-button type="submit" name="action" value="delete"
                        class="bg-red-600 hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus?')">Hapus
                        Produk</x-buttons.primary-button>
                </div>
            </form>
        </div>
    </section>

</x-guest-layout>
