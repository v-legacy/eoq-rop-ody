@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">

                    <h5 class="card-header">{{ $title }}</h5>
                    <h5 class=" me-2 text-end">Periode :&nbsp;{{ $data->barangk->tanggal_keluar }}</h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>{{ $data->barangs->nama_barang }}</td>
                                    </tr>
                                    <tr>
                                        <td>EOQ</td>
                                        <td>{{ round($data->eoq) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Frekuensi</td>
                                        <td>{{ $data->frekuensi }}</td>
                                    </tr>
                                    <tr>
                                        <td>ROP</td>
                                        <td>{{ $data->rop }}</td>
                                    </tr>

                                    <tr>
                                        <td>Total Biaya Simpan</td>
                                        <td>@currency($data->total_biaya_simpan)</td>
                                    </tr>
                                    <tr>
                                        <td>Total Biaya Pesan</td>
                                        <td>@currency($data->total_biaya_pesan)</td>
                                    </tr>
                                    <tr>
                                        <td>Total Biaya Persediaan</td>
                                        <td>@currency($data->total_biaya_persediaan)</td>
                                    </tr>




                                </tbody>
                            </table>
                            <button class="btn btn-secondary btn-sm mt-2"
                                onclick="window.location.href='/daftar-barang-keluar'">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
