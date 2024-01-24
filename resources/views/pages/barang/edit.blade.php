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
                        <form action="{{ url('update-barang/' . $barang->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nama Kategori</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="Makanan"
                                    name="kode_barang" value="{{ $barang->kode_barang }}" readonly>
                                @error('kode_barang')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nama Barang</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="indomie"
                                    name="nama_barang" value="{{ $barang->nama_barang }}">
                                @error('nama_barang')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="smallSelect" class="form-label">Kategori</label>
                                <select id="smallSelect" class="form-select form-select" name="kategori_id">
                                    <option selected disabled>Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option {{ $item->id == $barang->kategori_id ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">harga beli /Kg</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="harga_beli" value="{{ $barang->harga_beli }}">
                                @error('harga_beli')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">harga jual</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="harga_jual" value="{{ $barang->harga_jual }}">
                                @error('harga_jual')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Stock</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="stock" value="{{ $barang->stock }}" readonly>
                                @error('stock')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Biaya Pesan</label>
                                <input type="number" class="form-control" id="basic-default-fullname" min="0"
                                    name="biaya_pesan" value="{{ $barang->biaya_pesan }}">
                                @error('biaya_pesan')
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
