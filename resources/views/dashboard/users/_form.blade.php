<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <x-forms.input name="name" label="Nama" :value="old('name', $user->name ?? '')" />

    <x-forms.input type="email" name="email" label="Email" :value="old('email', $user->email ?? '')" />

    <x-forms.select label="Role" name="role" :options="['Admin' => 'Admin', 'Penjual' => 'Penjual', 'Pengunjung' => 'Pengunjung']" :selected="old('role', $user->role ?? 'Pengunjung')" />

    <x-forms.select label="Status" name="status" :options="['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif']" :selected="old('status', $user->status ?? 'Aktif')" />

    <x-forms.input type="password" name="password" label="Password" placeholder="Kosongkan jika tidak diubah" />
    <x-forms.input type="password" name="password_confirmation" label="Konfirmasi Password" />

</div>
