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


                        <a class="btn btn-dark ms-2 btn-sm" href="{{ url('tambah-users') }}">Tambah</a>
                        <table class="table table-hover text-sm">

                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>username</th>
                                    <th>akses user</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($data as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->username }}</td>
                                        <td>{{ $dt->akses_user }}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm"
                                                href="{{ url('reset-password/' . $dt->id) }}">Reset Password</a>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-users/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ url('delete-users/' . $dt->id) }}">Hapus</a>
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
