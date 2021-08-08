@extends('layouts.app', ['activePage' => 'absensi', 'titlePage' => __('Absensi')])

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
                  <th>Dari Tgl</th>
                  <th>Hingga Tgl</th>
                  <th>Alasan</th>
                  <th>Status</th>
                  <th>Disetujui oleh</th>
                  <th>Disetujui pada</th>
                  @if (auth()->user()->role=='admin')
                    <th>Aksi</th>
                  @endif

                </thead>
                <tbody>
                    @foreach ($absensi as $absen)
                        <tr>
                            <td>{{ $absen->tgl_awal }}</td>
                            <td>{{ $absen->tgl_akhir }}</td>
                            <td>{{ $absen->alasan }}</td>
                            @if ($absen->status=='menunggu')
                                <td><button type="button" class="btn btn-info btn-sm">{{ $absen->status }}</button></td>
                            @elseif($absen->status=='diterima')
                                <td><button type="button" class="btn btn-success btn-sm">{{ $absen->status }}</button></td>
                            @elseif ($absen->status=='ditolak')
                                <td><button type="button" class="btn btn-danger btn-sm">{{ $absen->status }}</button></td>
                            @endif
                            <td>{{ (isset($absen->admin_id)) ? $absen->admin->name : '-' }}</td>
                            <td>{{ (isset($absen->dikonfirmasi_pada)) ? $absen->dikonfirmasi_pada : '-' }}</td>

                            @if (auth()->user()->role=='admin')
                                <td>
                                    @if($absen->status=='menunggu')
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalUpdateAbsensi-"{{ $absen->id }}>Terima</button>
                                        <button type="button" class="btn btn-danger btn-sm">Tolak</button>

                                        <div class="modal fade" id="modalUpdateAbsensi-"{{ $absen->id }} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('absensi.update',$absen->id) }}" method="PUT">
                                                  @csrf
                                                  <div class="modal-body">
                                                    <input type="hidden" name="idAbsensi" value="{{ $absen->id }}">
                                                    Apakah anda yakin ingin menerima pengajuan absensi terkait?
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <input type="submit" class="btn btn-primary" value="Terima">
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endif
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
<!-- Modal -->
<div class="modal fade" id="modalAbsensi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Pengajuan Absensi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tgl_sekarang" value="{{ date('Y-m-d') }}">
        <div class="modal-body">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Alasan</label>
                <select class="form-control" name="alasan">
                  <option value="cuti">Cuti</option>
                  <option value="sakit">Sakit</option>
                </select>
              </div>
            <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="inputAddress">Tanggal Awal</label>
                <input type="date" class="form-control" name="tgl_awal">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="inputAddress">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tgl_akhir">
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" value="Ajukan">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
