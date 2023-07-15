@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <h5 class="card-header">{{ $title }}</h5>
                    <div class="card-body">
                        <style>
                            th {
                                font-size: 12px !important;
                            }
                        </style>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered text-sm" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>EOQ</th>
                                        <th>frekuensi</th>
                                        <th>Rop</th>
                                        <th>Biaya Simpan</th>
                                        <th>Biaya Pesan</th>
                                        <th>Biaya Persediaan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td class="text-center">{{ $dt->barangs->nama_barang }} <br />
                                                {{ $dt->barangs->kode_barang }}</td>

                                            <td>{{ round($dt->eoq) }}</td>
                                            <td>{{ $dt->frekuensi }}</td>
                                            <td>{{ $dt->rop }}</td>
                                            <td>@currency($dt->total_biaya_simpan)</td>
                                            <td>@currency($dt->total_biaya_pesan)</td>
                                            <td>@currency($dt->total_biaya_persediaan)</td>
                                            <td>{{ $dt->barangk->tanggal_keluar }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
