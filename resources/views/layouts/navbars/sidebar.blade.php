<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
        @if (auth()->user()->role=='karyawan')
          <li class="nav-item{{ $activePage == 'presensi' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('presensi.index') }}">
              <i class="material-icons">content_paste</i>
                <p>{{ __('Presensi') }}</p>
            </a>
          </li>
        @endif

      <li class="nav-item{{ $activePage == 'absensi' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('absensi.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Absensi') }}</p>
        </a>
      </li>
      @if (auth()->user()->role=='admin')
        <li class="nav-item{{ $activePage == 'laporan' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('presensi.laporan') }}">
            <i class="material-icons">content_paste</i>
                <p>{{ __('Laporan') }}</p>
            </a>
        </li>
      @endif
    </ul>
  </div>
</div>
