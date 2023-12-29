@extends('layouts_mahasiswa.master')
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
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <div class="card-body pt-0">
                            <div class="row g-5">
                                <!-- Informasi ringkas -->
                                <div class="col-lg-6">
                                    <div class="card bg-primary">
                                        <div class="card-body">
                                            <h3 class="card-title text-white">Selamat Datang di Dashboard!,  {{ $user['nama_Lengkap'] }}</h3>
                                            <p class="card-text text-white">Layanan BAAK ini menyediakan layanan layanan untuk , meminta surat , meminta izin IB , meminta izin IK dan Membooking Ruangan</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Statistik Pengguna -->
                                <div class="col-lg-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="card-title">Hot News</h3>
                                            <p class="card-text">- Mahasiswa Sebentar Lagi Ujian Akhir Semester</p>
                                            <p class="card-text">- Semangat Menuju Liburan Natal</p>
                                            <p class="card-text">- Jadwal Masuk Kampus 2024</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Grafik atau Diagram -->
                             
                        
                                <!-- Informasi tambahan lainnya -->
                                <div class="col-lg-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="card-title">Informasi Tambahan</h3>
                                            <p class="card-text"></p>
                                            <p class="card-text">Website Layanan BAAK ini baru dibangun dalam waktu 3 minggu.....</p>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Aktivitas Terkini -->
                                <div class="col-lg-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h3 class="card-title">Aktivitas Terkini</h3>
                                            <ul class="list-group">
                                                <li class="list-group-item">Ujian</li>
                                                <li class="list-group-item">Liburan</li>
                                                <!-- Tambahkan lebih banyak aktivitas jika diperlukan -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
