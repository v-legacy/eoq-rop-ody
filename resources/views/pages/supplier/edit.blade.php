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
                        <form action="{{ url('update-supplier/' . $supplier->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nama Supplier</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder="PT ABC"
                                    name="nama_supplier" value="{{ $supplier->nama_supplier }}">
                                @error('nama_supplier')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Email Supplier</label>
                                <input type="text" class="form-control" id="basic-default-fullname"
                                    placeholder="supplier@example.com" name="email_supplier"
                                    value="{{ $supplier->email_supplier }}">
                                @error('email_supplier')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">No Hp</label>
                                <input type="text" class="form-control" id="basic-default-fullname"
                                    placeholder="0812929291" name="no_hp" value="{{ $supplier->no_hp }}">
                                @error('no_hp')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-message">Alamat</label>
                                <textarea id="basic-default-message" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                                    name="alamat">{{ $supplier->alamat }}</textarea>
                                @error('alamat')
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
