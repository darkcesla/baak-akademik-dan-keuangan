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
                                    <div class="card-title">
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="row g-5">
                                        <!-- Informasi ringkas -->
                                        <div class="col-lg-6">
                                            <div class="card bg-primary">
                                                <div class="card-body">
                                                    <h3 class="card-title text-white">Selamat Datang di Dashboard!,BAAK  {{ $user['nama_Lengkap'] }}</h3>
                                                    <p class="card-text text-white">Layanan BAAK ini menyediakan layanan layanan untuk , meminta surat , meminta izin IB , meminta izin IK dan Membooking Ruangan</p>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <!-- Statistik Pengguna -->
                                        <div class="col-lg-6" style="margin-bottom: 5px;">
                                                <div class="card-body">
                                                    <h3 class="card-title">Hot News</h3>
                                                    <p class="card-text">- Mahasiswa Sebentar Lagi Ujian Akhir Semester</p>
                                                    <p class="card-text">- Semangat Menuju Liburan Natal</p>
                                                    <p class="card-text">- Jadwal Masuk Kampus 2024</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            
                                         <div class="row d-flex justify-content-center">
                                            <div class="col-md-4 mb-8">
                                            <div class="bg-light p-3">
                                                <i  style="font-size:36px;" class="fas fa-calendar-alt fa-10x mb-10"></i>
                                                <h4> Booking Ruangan </h4>
                                                <p> Req Pending    :{{ $countPending = count(array_filter($Booking, function($booking) {
                                                    return $booking['status'] === 'Pending';
                                                }));
                                                 }} </p>
                                                <p> Total Rejected : {{ $countPending = count(array_filter($Booking, function($booking) {
                                                    return $booking['status'] === 'Rejected';
                                                }));
                                                 }}
                                                 </p>
                                                <p> Total Approve  : 
                                                {{ $countPending = count(array_filter($Booking, function($booking) {
                                                    return $booking['status'] === 'Approve';
                                                }));
                                                 }}
                                                
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-8">
                                            <div class="bg-light p-3">
                                                <i  style="font-size:36px;" class="fas fa-moon fa-10x mb-10"></i>
                                                <h4> Request Izin Bermalam </h4>
                                                <p> Req Pending    :{{ $countPending = count(array_filter($izinbermalam, function($Izinbermalam) {
                                                    return $Izinbermalam['status'] === 'Pending';
                                                }));
                                                 }} </p>
                                                <p> Total Rejected : {{ $countPending = count(array_filter($izinbermalam, function($Izinbermalam) {
                                                    return $Izinbermalam['status'] === 'Rejected';
                                                }));
                                                 }}
                                                 </p>
                                                <p> Total Approve  : 
                                                    {{ $countPending = count(array_filter($izinbermalam, function($Izinbermalam) {
                                                        return $Izinbermalam['status'] === 'Approve';
                                                    }));
                                                     }}
                                                
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-8">
                                            <div class="bg-light p-3">
                                                <i  style="font-size:36px;" class="fas fa-sign-out-alt fa-10x mb-10"></i>
                                                <h4> Request Izin Keluar </h4>
                                                <p> Req Pending    :
                                                    {{ $countPending = count(array_filter($izinkeluar, function($Izinkeluar) {
                                                        return $Izinkeluar['status'] === 'Pending';
                                                    }));
                                                     }}    
                                                </p>
                                                <p> Total Rejected :
                                                    {{ $countPending = count(array_filter($izinkeluar, function($Izinkeluar) {
                                                        return $Izinkeluar['status'] === 'Rejected';
                                                    }));
                                                     }}    
                                                </p>
                                                <p> Total Approve  : 
                                                    {{ $countPending = count(array_filter($izinkeluar, function($Izinkeluar) {
                                                        return $Izinkeluar['status'] === 'Approve';
                                                    }));
                                                     }}    
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-4 mb-8">
                                            <div class="bg-light p-3">
                                                <i  style="font-size:36px;" class="fas fa-envelope fa-50x mb-10"></i>
                                                <h4> Request Surat </h4>
                                                <p> Req Pending    :
                                                    {{ $countPending = count(array_filter($surat, function($surat) {
                                                        return $surat['status'] === 'Pending';
                                                    }));
                                                     }}    
                                                </p>
                                                <p> Total Rejected :
                                                    {{ $countPending = count(array_filter($surat, function($surat) {
                                                        return $surat['status'] === 'Rejected';
                                                    }));
                                                     }}    
                                                </p>
                                                <p> Total Approve  : 
                                                    {{ $countApprove = count(array_filter($surat, function($surat) {
                                                        return $surat['status'] === "Approve";
                                                    }));
                                                     }}    
                                                </p>                
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-8">
                                            <div class="bg-light p-3">
                                                <i  style="font-size:36px;" class="fas fa-tshirt fa-50x mb-10"></i>
                                                <h4> Pesanan Kaos </h4>
                                                <p> Total  : {{ count($pemesanankaos) }} </p>
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
</div>
</div>
@endsection
