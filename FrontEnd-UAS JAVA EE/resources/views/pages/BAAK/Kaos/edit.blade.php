@extends('layouts.master')
@section('title', 'Edit Kaos')
@section('page', 'Edit Kaos')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Dashboards</li>
        <li class="breadcrumb-item text-muted">Kaos</li>
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
                        <h1>Edit Kaos</h1>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">  
                        <form action="{{ route('Editkaos', ['id' => $kaos['id'] ]) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="ukuran" class="form-label">Ukuran</label>
                                <input type="text" class="form-control col-md-6" id="ukuran" name="ukuran" value="{{ $kaos['ukuran'] }}" required placeholder="Masukkan Ukuran">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control col-md-3" id="harga" name="harga" value="{{ $kaos['harga'] }}" required placeholder="Masukkan Harga" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control col-md-6" id="keterangan" name="keterangan" required placeholder="Masukkan Keterangan">{{ $kaos['keterangan'] }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Kaos</button>
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
