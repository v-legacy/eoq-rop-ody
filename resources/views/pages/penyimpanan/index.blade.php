@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <h5 class="card-header">{{ $title }}</h5>

                    <div class="table-responsive text-nowrap">

                        @if (session('success'))
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                </div>
                            </div>
                        @elseif(session('failed'))
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="alert alert-danger">{{ session('failed') }}</div>
                                </div>
                            </div>
                        @endif


                        <a class="btn btn-dark ms-2 btn-sm" href="{{ url('tambah-biaya') }}">Tambah</a>
                        <table class="table table-hover text-sm">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Persentase %</th>
                                    <th>Biaya Simpan %</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->barangs->kode_barang }}</td>
                                        <td>{{ $dt->barangs->nama_barang }}</td>
                                        <td>@currency($dt->barangs->harga_beli)</td>
                                        <td>{{ $dt->persentase . '%' }}</td>
                                        <td>@currency($dt->biaya_simpan)</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-biaya/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('delete-biaya/' . $dt->id) }}">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
