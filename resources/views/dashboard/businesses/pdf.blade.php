<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ public_path('img/application-logo.svg') }}" type="image/x-icon">

    {{-- Judul Halaman --}}
    <title>Data UMKM Kabupaten Minahasa</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        header {
            display: table;
            width: 100%;
            padding-bottom: 10px;
            margin-bottom: 20px;
            border-bottom: 1px double black;
        }

        .logo {
            display: table-cell;
            width: 25%;
            vertical-align: middle;
            text-align: right;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .letterhead-text {
            display: table-cell;
            width: 75%;
            text-align: center;
            vertical-align: middle;
            padding-right: 100px;
        }

        .letterhead-text h1,
        .letterhead-text h2,
        .letterhead-text address {
            line-height: 1.5;
            margin: 0;
            text-transform: uppercase;
        }

        .letterhead-text h1 {
            font-size: 18pt;
        }

        .letterhead-text h2 {
            font-size: 14pt;
        }

        .letterhead-text address {
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }

        th,
        td {
            border: 1px solid black;
            padding: 3px;
        }

        th {
            background: #f0f0f0;
        }

        td {
            text-align: left;
            vertical-align: top;
        }
    </style>

</head>

<body>
    <header>
        <div class="logo">
            <img src="{{ public_path('img/logo-minut.webp') }}" alt="Logo Kabupaten Minahasa Utara">
        </div>
        <div class="letterhead-text">
            <h1>Pemerintah Kabupaten Minahasa Utara</h1>
            <h2>Dinas Tenaga Kerja Koperasi dan Usaha Kecil Menengah</h2>
            <address>Jl. Worang by Pass Manado - Bitung KM 22 Airmadidi</address>
        </div>
    </header>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Pemilik</th>
                <th>NIK</th>
                <th>Provinsi</th>
                <th>Kota/Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan/Desa</th>
                <th>Tipe Usaha</th>
                <th>Kategori</th>
                <th>Produk</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($businesses as $business)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $business->name }}</td>
                    <td>{{ $business->owner_name }}</td>
                    <td>{{ $business->owner_nik }}</td>
                    <td>{{ $business->province }}</td>
                    <td>{{ $business->city }}</td>
                    <td>{{ $business->district }}</td>
                    <td>{{ $business->village }}</td>
                    <td>{{ $business->business_type }}</td>
                    <td>{{ $business->category->name }}</td>
                    <td>
                        {{ Str::limit($business->products->pluck('name')->implode(', '), 50) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
