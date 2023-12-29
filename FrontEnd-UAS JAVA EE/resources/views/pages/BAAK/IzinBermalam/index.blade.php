@extends('layouts.master')
@section('title', 'Izin bermalam Kampus')
@section('page', 'Izin Bermalam Kampus')
@section('breadcrumb')
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">Izin Bermalam Kampus</li>
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
                              
                                <!--begin::Card body-->
                                <div class="card-body pt-0">  
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    </div>
                                    @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                    <h1>Izin Bermalam Kampus</h1>
                                    <hr>
                                    <div class="mb-3 d-flex justify-content-end">
                                      <select class="form-select form-control-sm w-25" id="statusFilter" onchange="filterByStatus()">
                                          <option value="All">Semua</option>
                                          <option value="Approve">Approve</option>
                                          <option value="Rejected">Rejected</option>
                                          <option value="Pending">Pending</option>
                                      </select>
                                  </div>
                                  
                                    @if(count($izinbermalam) > 0)
                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th> Nama Mahasiswa </th>
                                                    <th>Keperluan</th>
                                                    <th>Tujuan</th>
                                                    <th>Waktu IB</th>
                                                    <th>Status</th>
                                                    <th>Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($izinbermalam as $data)
                                                @if($data['status'] != "Canceled") 
                                                    <tr>
                                                        <td>{{ $data['id'] }}</td>
                                                        <td>{{ $data['user']['nama_Lengkap'] }} - {{ $data['user']['nim'] }}</td>
                                                        <td>{{ $data['keterangan'] }}</td>
                                                        <td>{{ $data['tujuan'] }} </td>
                                                        <td>{{ \Carbon\Carbon::parse($data['waktuBerangkat'])->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($data['waktuKembali'])->format('d/m/Y H:i') }}</td>                                                        <td>{{ $data['status'] }}</td>
                                                        <td> 
                                                            @if($data['status'] == "Approve" || $data['status'] == "Rejected") 
                                                            -
                                                            @else
                                                            <a href="{{ route('Approve_IB', ['id' => $data['id']]) }}" class="btn-edit">
                                                              <i class="fa fa-check-square	
                                                              "></i> Approve |
                                                            </a>
                                                            <!-- Tombol hapus dengan ikon -->
                                                            <a href="{{ route('Rejected_IB', ['id' => $data['id']]) }}" class="btn-delete">
                                                              <i class="fas fa-times	"></i> Rejected
                                                            </a>
                                                            @endif
              
                                                          </td> 
 
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-4 d-flex justify-content-center">
                                            <div id="pagination-links" class="mt-4">
                                    @else
                                        <p>Tidak ada Data Izin Bermalam</p>
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
        </div>
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
            var statusCell = row.getElementsByTagName('td')[5]; // Ubah indeks sesuai dengan kolom status

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





      
 
