@extends('layouts.app', ['activePage' => 'absensi', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Pengajuan Absensi</h4>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAbsensi">
              Ajukan Absensi
            </button>
            <div class="table-responsive">
              <table class="table" id="table-presensi">
                <thead class=" text-primary">
                  <th>Periode</th>
                  <th>Karyawan</th>
                  <th>Total Presensi</th>
                  <th>Total Absensi</th>
                  <th>Total Cuti</th>
                  <th>Total Sakit</th>
                  <th>Total Tanpa Keterangan</th>
                </thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
