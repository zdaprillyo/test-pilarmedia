@extends('layouts.app', ['activePage' => 'presensi', 'titlePage' => __('Presensi')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Presensi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('presensi.store') }}" method="POST">
                    @csrf
                    @if (!auth()->user()->isAttend())
                        <input type="submit" class="btn btn-primary" name="submit" value="Presensi Masuk">
                    @elseif(auth()->user()->isHome())
                        <h4>Anda sudah presensi pulang</h4>
                     @else
                        <input type="submit" class="btn btn-warning" name="submit" value="Presensi Pulang">
                    @endif
                </form>
            </div>
          </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Riwayat Presensi</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table-presensi">
                <thead class=" text-primary">
                  <th>Periode</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                  <th>Keterangan</th>
                </thead>
                <tbody>
                    @foreach ($attandances as $p)
                        <tr>
                            <td>{{ $p->periode }}</td>
                            <td>{{ $p->masuk }}</td>
                            <td>{{ $p->keluar }}</td>
                            <td>{{ $p->ket }}</td>
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
