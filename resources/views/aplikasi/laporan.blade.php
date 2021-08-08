@extends('layouts.app', ['activePage' => 'laporan', 'titlePage' => __('Laporan')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Laporan Performa Karyawan</h4>
            <p class="card-category"> Periode {{ date('M Y') }}</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table-presensi">
                <thead class=" text-primary">
                  <th>Karyawan</th>
                  <th>Total Presensi</th>
                  <th>Total Absensi</th>
                  <th>Total Cuti</th>
                  <th>Total Sakit</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->getPresenCount() }} kali</td>
                            <td>{{ $user->getAbsenCount() }} kali</td>
                            <td>{{ $user->getCutiCount() }} kali</td>
                            <td>{{ $user->getSakitCount() }} kali</td>
                        </tr>
                    @endforeach
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
