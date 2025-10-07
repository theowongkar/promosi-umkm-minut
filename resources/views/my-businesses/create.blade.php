<x-guest-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Tambah Data Usaha</x-slot>

    {{-- Bagian Tambah Usaha --}}
    <section>
        {{-- Flash Message --}}
        <x-alerts.flash-message />

        {{-- Konten Utama --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 xl:px-10 py-8">
            <h2 class="mb-6 text-xl font-bold">Tambah Data Usaha</h2>

            <form action="{{ route('my-business.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Data Usaha --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-forms.input type="text" label="Nama Usaha" name="name" value="{{ old('name') }}" />
                    <x-forms.select label="Kategori Usaha" name="business_category_id" :options="$businessCategories->pluck('name', 'id')" />
                    <x-forms.select label="Jenis Usaha" name="business_type" :options="['Mikro' => 'Mikro', 'Kecil' => 'Kecil', 'Menengah' => 'Menengah']" />
                    <x-forms.input type="file" label="Foto Usaha (opsional)" name="image_path" accept="image/*" />
                </div>

                {{-- Data Pemilik --}}
                <h2 class="text-lg font-semibold mt-6 mb-2">Data Pemilik Usaha</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-forms.input type="text" label="Nama Pemilik" name="owner_name"
                        value="{{ old('owner_name') }}" />
                    <x-forms.input type="text" label="NIK Pemilik" name="owner_nik" maxlength="16"
                        value="{{ old('owner_nik') }}" />
                    <x-forms.input type="text" label="Nomor Telepon" name="owner_phone"
                        value="{{ old('owner_phone') }}" />
                </div>

                {{-- Alamat Usaha --}}
                <h2 class="text-lg font-semibold mt-6 mb-2">Alamat Usaha</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Ini pakai x-forms.select --}}
                    <x-forms.select label="Provinsi" name="province" :options="[]" id="province" />
                    <x-forms.select label="Kota/Kabupaten" name="city" :options="[]" id="city" />
                    <x-forms.select label="Kecamatan" name="district" :options="[]" id="district" />
                    <x-forms.select label="Desa/Kelurahan" name="village" :options="[]" id="village" />

                    <x-forms.textarea label="Alamat Lengkap" name="address" rows="3"
                        value="{{ old('address') }}"></x-forms.textarea>
                </div>

                {{-- Tombol Submit --}}
                <div class="pt-4">
                    <x-buttons.primary-button href="{{ route('my-business.index') }}"
                        class="mr-1 bg-gray-600 hover:bg-gray-700">Kembali</x-buttons.primary-button>
                    <x-buttons.primary-button type="submit">Simpan Usaha</x-buttons.primary-button>
                </div>
            </form>
        </div>
    </section>

    {{-- Script API IBNux --}}
    <script>
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        const districtSelect = document.getElementById('district');
        const villageSelect = document.getElementById('village');

        // Ambil old value dari Blade
        const oldProvince = @json(old('province'));
        const oldCity = @json(old('city'));
        const oldDistrict = @json(old('district'));
        const oldVillage = @json(old('village'));

        let provinces = [];
        let cities = [];
        let districts = [];

        // Fetch provinsi
        fetch('https://ibnux.github.io/data-indonesia/provinsi.json')
            .then(res => res.json())
            .then(data => {
                provinces = data;
                provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
                data.forEach(p => {
                    const selected = (p.nama === oldProvince) ? 'selected' : '';
                    provinceSelect.innerHTML +=
                        `<option value="${p.nama}" data-id="${p.id}" ${selected}>${p.nama}</option>`;
                });

                // Kalau ada oldProvince, load kota
                if (oldProvince) {
                    const provId = provinces.find(p => p.nama === oldProvince)?.id;
                    if (provId) loadCities(provId);
                }
            });

        function loadCities(provId) {
            fetch(`https://ibnux.github.io/data-indonesia/kabupaten/${provId}.json`)
                .then(res => res.json())
                .then(data => {
                    cities = data;
                    citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
                    data.forEach(c => {
                        const selected = (c.nama === oldCity) ? 'selected' : '';
                        citySelect.innerHTML +=
                            `<option value="${c.nama}" data-id="${c.id}" ${selected}>${c.nama}</option>`;
                    });

                    if (oldCity) {
                        const cityId = cities.find(c => c.nama === oldCity)?.id;
                        if (cityId) loadDistricts(cityId);
                    }
                });
        }

        function loadDistricts(cityId) {
            fetch(`https://ibnux.github.io/data-indonesia/kecamatan/${cityId}.json`)
                .then(res => res.json())
                .then(data => {
                    districts = data;
                    districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    data.forEach(d => {
                        const selected = (d.nama === oldDistrict) ? 'selected' : '';
                        districtSelect.innerHTML +=
                            `<option value="${d.nama}" data-id="${d.id}" ${selected}>${d.nama}</option>`;
                    });

                    if (oldDistrict) {
                        const districtId = districts.find(d => d.nama === oldDistrict)?.id;
                        if (districtId) loadVillages(districtId);
                    }
                });
        }

        function loadVillages(districtId) {
            fetch(`https://ibnux.github.io/data-indonesia/kelurahan/${districtId}.json`)
                .then(res => res.json())
                .then(data => {
                    villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
                    data.forEach(v => {
                        const selected = (v.nama === oldVillage) ? 'selected' : '';
                        villageSelect.innerHTML += `<option value="${v.nama}" ${selected}>${v.nama}</option>`;
                    });
                });
        }

        // Listener manual
        provinceSelect.addEventListener('change', () => {
            const provId = provinces.find(p => p.nama === provinceSelect.value)?.id;
            citySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
            if (provId) loadCities(provId);
        });

        citySelect.addEventListener('change', () => {
            const cityId = cities.find(c => c.nama === citySelect.value)?.id;
            districtSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
            if (cityId) loadDistricts(cityId);
        });

        districtSelect.addEventListener('change', () => {
            const districtId = districts.find(d => d.nama === districtSelect.value)?.id;
            villageSelect.innerHTML = '<option value="">Pilih Desa/Kelurahan</option>';
            if (districtId) loadVillages(districtId);
        });
    </script>

</x-guest-layout>
