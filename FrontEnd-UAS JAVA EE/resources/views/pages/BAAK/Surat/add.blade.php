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
                            <h1>Add kaos</h1>
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif
                        <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="bg-light p-3">
                                        <h5>Berikut Data Request  <span>{{ $data['id'] }}</span></h5>
                                        <label>Nama Mahasiswa Yang Request:</label>
                                        <input type="text" class="form-control" value="{{ $data['user']['nama_Lengkap'] }}" readonly>
                                        <label>NIM Mahasiswa Yang Request:</label>
                                        <input type="text" class="form-control" value="{{ $data['user']['nim'] }}" readonly>
                                        <label>Topik Request Surat:</label>
                                        <input type="text" class="form-control" value="{{ $data['topic'] }}" readonly>
                                        <label>Keterangan Request Surat:</label>
                                        <textarea class="form-control" readonly>{{ $data['keterangan_surat'] }}</textarea>
                                        <label>Status:</label>
                                        <input type="text" class="form-control" value="{{ $data['status'] }}" readonly>
                                    </div>
                                </div>
                        </div>
                        

                        <form action="{{ route('Approve_Surat', ['id' => $data['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_surat" class="form-label">File Surat</label>
                                <input type="file" class="form-control" id="nama_surat" name="nama_surat" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Approve</button>
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
