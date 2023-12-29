@extends('layouts_mahasiswa.master')
@section('title', 'Pesan Kaos')
@section('page', 'Pesan Kaos ')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Pesanan Kaos</li>
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
                            <h1>Pesan Kaos</h1>
                            <form action="{{ route('AddPaymentKaos') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="selection" class="form-label">Pilih Ukuran Baju</label>
                                    <select class="form-select" name="kaos_id" id="selection">
                                        @foreach($kaos as $data)
                                            <option value="{{ $data['id'] }}">{{ $data['ukuran'] }}</option>
                                        @endforeach
                                    </select>
                                </div>       
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Jenis Pembayaran</label>
                                    <select class="form-select" name="jenis_pembayaran" id="selection">
                                        <option value="DANA">DANA</option>
                                        <option value="OVO">OVO</option>
                                        <option value="Rekening Bank">Rekening Bank</option>
                                    </select>
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Pembayaran Nominal</label>
                                        <input type="number" class="form-control col-md-3" id="harga" name="nominal_pembayaran" required placeholder="Masukkan Harga" min="1">
                                    </div>
                                </div>                         
                               
                                <button type="submit" class="btn btn-primary">Add Pesanan Kaos</button>
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
