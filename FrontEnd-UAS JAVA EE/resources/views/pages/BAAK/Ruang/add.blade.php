@extends('layouts.master')
@section('title', 'Dashboard')
@section('page', 'Dashboard')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Dashboards</li>
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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <!--end::Card title-->
                        <!-- Form to create a new room -->
                        <div class="card-body pt-0">  
                            <h1>Add Ruangan</h1>
                        <form action="{{ route('addruangan') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                <input type="text" class="form-control col-md-6" id="nama_ruangan" name="nama_ruangan" required placeholder="Masukkan Nama Ruangan">
                            </div>
                            <div class="mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas</label>
                                <input type="number" class="form-control col-md-3" id="kapasitas" name="kapasitas" required placeholder="Masukkan Kapasitas" min="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Ruangan</button>
                        </form>
                    </div>
                    <!--end::Card header-->
                    </div>
                </div>
                <!--end::Products-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
