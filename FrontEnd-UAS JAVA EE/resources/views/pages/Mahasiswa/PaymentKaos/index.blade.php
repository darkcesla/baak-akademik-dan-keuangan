@extends('layouts_mahasiswa.master')
@section('title', 'Kaos IT DEL')
@section('page', 'Kaos IT DEL')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Kaos IT DEL</li>
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
                                    <a href="{{ route('Add_PaymentKaos') }}" class="btn btn-primary ms-auto">Beli Kaos</a>
                                    <a href="{{ route('PaymentKaos') }}" class="btn btn-primary ">History Pemesanan</a>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">  
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <h1>Kaos IT DEL</h1>
                                    @if(count($kaos) > 0)
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Ukuran Baju</th>
                                                    <th>Harga</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($kaos as $data)
                                                    <tr>
                                                        <td>{{ $data['id'] }}</td>
                                                        <td>{{ $data['ukuran'] }}</td>
                                                        <td>{{ $data['harga'] }}</td>
                                                        <td>{{ $data['keterangan'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <div id="pagination-links" class="mt-4">
                                    @else
                                        <p>Tidak ada data Baju</p>
                                    @endif
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
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tableRows = document.querySelectorAll('.table tbody tr');
            var rowsPerPage = 10; // Jumlah baris per halaman
            var paginationContainer = document.getElementById('pagination-links');
            var totalRows = tableRows.length;
            var currentPage = 1; // Halaman saat ini
            var totalPages = Math.ceil(totalRows / rowsPerPage);

            function showPage(page) {
                currentPage = page;

                var start = (page - 1) * rowsPerPage;
                var end = start + rowsPerPage;

                tableRows.forEach(function(row, index) {
                    if (index >= start && index < end) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });

                updatePaginationLinks(); // Memperbarui tampilan kotak pagination
            }

            function createPaginationLinks() {
                var links = '';
                for (var i = 1; i <= totalPages; i++) {
                    links += `<span style="padding:10px;margin:5px;" class="border border-primary"><a href="#" class="pagination-link " data-page="${i}">${i}</a></span>`;
                }
                paginationContainer.innerHTML = links;

                updatePaginationLinks(); // Memperbarui tampilan kotak pagination
            }

            function updatePaginationLinks() {
                var paginationLinks = paginationContainer.querySelectorAll('.pagination-link');
                paginationLinks.forEach(function(link) {
                    link.classList.remove('active');
                    if (parseInt(link.getAttribute('data-page')) === currentPage) {
                        link.classList.add('active');
                    }
                });
            }

            showPage(1); // Menampilkan halaman pertama saat halaman dimuat
            createPaginationLinks();

            paginationContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('pagination-link')) {
                    var selectedPage = parseInt(event.target.getAttribute('data-page'));
                    showPage(selectedPage);
                }
            });
        });
    </script>
@endsection





      
 
