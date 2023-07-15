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


                        <a class="btn btn-dark ms-2 btn-sm" href="{{ url('tambah-barang') }}">Tambah</a>
                        <table class="table table-hover text-sm" style="font-size: 11px;">

                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stock</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Biaya Pesan</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $dt)
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $dt->kode_barang }}</td>
                                        <td>{{ $dt->nama_barang }}</td>
                                        <td>{{ $dt->kategoris->nama_kategori }}</td>
                                        <td>{{ $dt->stock }}</td>
                                        <td>{{ $dt->harga_beli }}</td>
                                        <td>{{ $dt->harga_jual }}</td>

                                        <td>{{ $dt->biaya_pesan }}</td>

                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-barang/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('delete-barang/' . $dt->id) }}">Hapus</a>
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
