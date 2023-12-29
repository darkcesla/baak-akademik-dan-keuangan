@extends('layouts_mahasiswa.master')
@section('title', 'Izin Bermalam')
@section('page', 'Izin Bermalam')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Izin Bermalam</li>
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
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                            <h1>Request Izin Bermalam</h1>
                            <form action="{{ route('AddIB') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keperluan</label>
                                    <input type="text" class="form-control col-md-6" id="keterangan" name="keterangan" required placeholder="Masukkan Keterangan">
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Tujuan</label>
                                    <input type="text" class="form-control col-md-6" id="tujuan" name="tujuan" required placeholder="Masukkan Tujuan">
                                </div>
                                <div class="mb-3">
                                    <label for="waktuBerangkat" class="form-label">Waktu Berangkat</label>
                                    <input type="datetime-local" class="form-control col-md-6" id="waktuBerangkat" name="waktuBerangkat" required>
                                </div>
                                <div class="mb-3">
                                    <label for="waktuKembali" class="form-label">Waktu Kembali</label>
                                    <input type="datetime-local" class="form-control col-md-6" id="waktuKembali" name="waktuKembali" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Request Izin Bermalam</button>
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
