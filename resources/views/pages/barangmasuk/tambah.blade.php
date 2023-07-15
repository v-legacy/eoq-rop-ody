@extends('layout.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $title }}</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ url('post-barang-masuk') }}" method="POST">
                            @csrf
                            <div>
                                <label for="smallSelect" class="form-label">Supplier</label>
                                <select id="smallSelect" class="form-select form-select" name="supplier_id">
                                    <option selected disabled>Pilih Supplier</option>
                                    @foreach ($supplier as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_supplier }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="smallSelect" class="form-label">Nama Barang</label>
                                <select id="smallSelect" class="form-select form-select" name="barang_id">
                                    <option selected disabled>Pilih Barang</option>
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Qty</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="qty_masuk">
                                @error('qty_masuk')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">harga beli</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="harga_beli">
                                @error('harga_beli')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Persentase</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="persentase">
                                @error('persentase')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Tanggal Beli</label>
                                <input type="date" class="form-control" id="basic-default-fullname" min="0"
                                    name="tanggal_masuk">
                                @error('tanggal_masuk')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-dark btn-sm">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
