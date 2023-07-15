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
                        <form action="{{ url('post-users') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">username</label>
                                <input type="text" class="form-control" id="basic-default-fullname"
                                    placeholder="username" name="username">
                                @error('username')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="smallSelect" class="form-label">Akses User</label>
                                <select id="smallSelect" class="form-select form-select" name="akses_user">
                                    <option selected disabled>Pilih Akses</option>
                                    <option>admin</option>
                                    {{-- <option>petugas</option> --}}

                                </select>
                                @error('akses_user')
                                    <span class="text-danger text-sm"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">password</label>
                                <input type="password" class="form-control" id="basic-default-fullname"
                                    placeholder="password" name="password">
                                @error('password')
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
