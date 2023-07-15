@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center d-print-none">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $title }}</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('post-report') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Dari</label>
                                <input type="date" class="form-control" id="basic-default-fullname" name="dari">
                                @error('dari')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Sampai</label>
                                <input type="date" class="form-control" id="basic-default-fullname" name="sampai">
                                @error('sampai')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark btn-sm">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @isset($data)
            <style>
                @media print {
                    table {
                        width: 100% !important;
                        display: block !important;
                        font-size: 10px !important;
                        text-transform: lowercase !important;
                    }

                    table th {
                        text-transform: lowercase !important;
                        font-weight: l font-size: 10px !important;
                    }

                    table tr td {
                        font-size: 10px !important;
                    }

                    body {
                        width: 100%;
                        ;
                    }

                    .card {
                        display: block !important;
                        width: 100% !important;
                    }
                }
            </style>
            <div class="row justify-content-center">
                <div class="card">
                    <h5 class="card-header">{{ $result }}</h5>
                    <div class="card-body">
                        <a class="btn bg-gray btn-sm text-white d-print-none" href="#" onclick="window.print()">Print</a>
                        <div class="">
                            <table class="table table-bordered text-sm" style="font-size: 14px;">
                                <thead>
                                    <tr class="text-sm">
                                        {{-- <th>No</th> --}}
                                        <th>Barang</th>
                                        <th>EOQ</th>
                                        <th>Frek</th>
                                        <th>ROP</th>
                                        <th>Biaya Simpan</th>
                                        <th>Biaya Pesan</th>
                                        <th>Biaya Persediaan</th>
                                        <th>Tanggal Keluar</th>
                                        {{-- <th>ROP</th>
                                        <th>ROP</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            {{-- <td>{{ $loop->iteration }}</td> --}}
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>{{ round($item->eoq) }}</td>
                                            <td>{{ $item->frekuensi }}</td>
                                            <td>{{ $item->rop }}</td>
                                            <td>{{ $item->tanggal_keluar }}</td>
                                            <td>@currency($item->total_biaya_simpan)</td>
                                            <td>@currency($item->total_biaya_pesan)</td>
                                            <td>@currency($item->total_biaya_persediaan)</td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">Total</td>
                                        <td>@currency($t_simpan)</td>
                                        <td>@currency($t_pesan)</td>
                                        <td>@currency($t_persediaan)</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

    </div>
@endsection
