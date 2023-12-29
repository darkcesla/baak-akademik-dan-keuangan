@extends('layouts_mahasiswa.master')
@section('title', 'Izin keluar Kampus')
@section('page', 'Izin Keluar Kampus')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Izin Keluar Kampus</li>
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
                                    <!-- Tambah tombol "Tambah kaos" di samping -->
                                    <a href="{{ route('Add_IK') }}" class="btn btn-primary ms-auto">Request IK</a>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">  
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <h1>Izin Keluar </h1>
                                    <hr>
                                    <div class="mb-3 d-flex justify-content-end">
                                      <select class="form-select form-control-sm w-25" id="statusFilter" onchange="filterByStatus()">
                                          <option value="All">Semua</option>
                                          <option value="Approve">Approve</option>
                                          <option value="Rejected">Rejected</option>
                                          <option value="Pending">Pending</option>
                                          <option value="Canceled">Canceled</option>
                                      </select>
                                  </div>
                                    @if(count($izinkeluar) > 0)
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Keperluan</th>
                                                    <th>Waktu Izin Keluar</th>
                                                    <th>Status</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($izinkeluar as $data)
                                                    <tr>
                                                        <td>{{ $data['id'] }}</td>
                                                        <td>{{ $data['keterangan'] }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($data['waktuBerangkat'])->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($data['waktuKembali'])->format('d/m/Y H:i') }}</td>
                                                        <td>{{ $data['status'] }}</td>
                                                        <td> 
                                                           @if($data['status'] == "Canceled" || $data['status'] == "Approve" || $data['status'] == "Rejected") 
                                                            <p> - </p>
                                                          
                                                           @else
                                                            <a href="{{ route('Canceled_IK', ['id' => $data['id']]) }}" class="btn-edit">
                                                            <i class="fas fa-ban		
                                                            "></i> Canceled 
                                                            @endif

                                                        </td> 
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <div id="pagination-links" class="mt-4">
                                    @else
                                        <p>Tidak ada data Data</p>
                                    @endif
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

    function filterByStatus() {
        var statusFilter = document.getElementById('statusFilter');
        var selectedStatus = statusFilter.value;
        var table = document.querySelector('.table');

        var rows = table.getElementsByTagName('tr');

        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var statusCell = row.getElementsByTagName('td')[3]; // Ubah indeks sesuai dengan kolom status

            if (selectedStatus === 'All') {
                row.style.display = '';
            } else {
                if (statusCell) {
                    var cellText = statusCell.textContent || statusCell.innerText;
                    if (cellText !== selectedStatus) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                }
            }
        }
    }
</script>
@endsection





      
 
