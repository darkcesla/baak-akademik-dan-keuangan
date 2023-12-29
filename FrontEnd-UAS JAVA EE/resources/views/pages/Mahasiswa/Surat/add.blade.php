@extends('layouts_mahasiswa.master')
@section('title', 'Request Surat')
@section('page', 'Request Surat')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Request Surat</li>
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
                            <h1>Request Surat</h1>
                            <form method="POST" action="{{ route('AddSurat') }}" enctype="multipart/form-data">
                                @csrf
    
                                <div class="mb-3">
                                    <label for="topic" class="form-label">Topik Surat</label>
                                    <input type="text" class="form-control" id="topic" name="topic" required>
                                </div>
    
                                <div class="mb-3">
                                    <label for="keterangan_surat" class="form-label">Keterangan Surat</label>
                                    <textarea class="form-control" id="keterangan_surat" name="keterangan_surat" required></textarea>
                                </div>
                                
    
                                <button type="submit" class="btn btn-primary">Request Surat</button>
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


   