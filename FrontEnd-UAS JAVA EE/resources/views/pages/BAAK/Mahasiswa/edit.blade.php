@extends('layouts.master')
@section('title', 'Edit User')
@section('page', 'Edit User')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Dashboards</li>
        <li class="breadcrumb-item text-muted">Users</li>
        <li class="breadcrumb-item text-muted">Edit</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <h1>Edit User</h1>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">  
                        <form action="{{ route('EditUser', ['id' => $users['id'] ]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control col-md-6" id="nama_lengkap" name="nama_lengkap" value="{{ $users['nama_Lengkap'] }}" required placeholder="Masukkan Nama Lengkap">
                            </div>
                            <div class="mb-3">
                                <label for="noHandphone" class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control col-md-6" id="noHandphone" name="noHandphone" value="{{ $users['nomor_Handphone'] }}" required placeholder="Masukkan Nomor Handphone">
                            </div>
                            <div class="mb-3">
                                <label for="NIK" class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control col-md-6" id="NIK" name="NIK" value="{{ $users['nomor_KTP'] }}" required placeholder="Masukkan Nomor KTP">
                            </div>
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control col-md-6" id="nim" name="nim" value="{{ $users['nim'] }}" required placeholder="Masukkan NIM">
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
