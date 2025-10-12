@extends('layouts.grim.index', ['title' => 'Dashboard Admin', 'section_header' => 'Dashboard Admin'])

@section('content')
<style>
.card-modern {
  border: none;
  border-radius: 5px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  overflow: hidden;
}
.card-modern:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}
.card-modern .card-icon {
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 22px;
}
.card-modern .card-body {
  font-size: 28px;
  font-weight: 700;
  color: #333;
}
.card-modern .card-header h4 {
  font-weight: 600;
  color: #555;
}
</style>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
        <a href="{{ route('admin.users.index') }}">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-users"></i>
            </div>
        </a>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Pengguna</h4>
        </div>
        <div class="card-body">
          {{ $total_users }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
        <a href="{{ route('admin.books.index') }}">
            <div class="card-icon shadow-info bg-info">
                <i class="fas fa-book"></i>
            </div>
        </a>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Buku</h4>
        </div>
        <div class="card-body">
          {{ $total_books }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
        <a href="{{ route('admin.book-types.index') }}">
            <div class="card-icon shadow-success bg-success">
                <i class="fas fa-tags"></i>
            </div>
        </a>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Kategori Buku</h4>
        </div>
        <div class="card-body">
          {{ $total_book_types }}
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
        <a href="{{ route('admin.book-borrowers.index') }}">
            <div class="card-icon shadow-warning bg-warning">
                <i class="fas fa-hand-holding"></i>
            </div>
        </a>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Total Peminjaman</h4>
        </div>
        <div class="card-body">
          {{ $total_borrowings }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h4>Status Peminjaman</h4>
      </div>
      <div class="card-body">
        <canvas id="borrowingsChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-lg-8 col-md-6 col-sm-12">
    <div class="card shadow-sm border-0 rounded-lg">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Log Pengguna</h5>
        <div>
          <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#staticBackdrop">
            Lihat semua
          </button>
        </div>
      </div>
      <div class="card-body p-3" style="max-height: 400px; overflow-y: auto;">
        <ul class="list-unstyled mb-0">
          @forelse($authenticate_logs as $log)
          <li class="media mb-3 p-2 rounded shadow-sm bg-light">
            <img src="{{ $log->user->image ? asset($log->user->image) : asset('public/assets/img/avatar/default.png') }}" alt="User Avatar" class="mr-3 rounded-circle" style="width: 48px; height: 48px; object-fit: cover;">
            <div class="media-body">
              <h6 class="mt-0 mb-1">{{ $log->user->name }}</h6>
              <small class="text-muted">IP: {{ $log->last_login_ip }}</small><br>
              <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
            </div>
          </li>
          @empty
          <li class="text-center text-danger font-weight-bold text-uppercase">Data tidak ada!</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@push('modal')
@include('admin.dashboard.modal.show')
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('borrowingsChart').getContext('2d');
  var borrowingsChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Disetujui', 'Menunggu', 'Ditolak'],
      datasets: [{
        data: [{{ $approved_borrowings }}, {{ $pending_borrowings }}, {{ $rejected_borrowings }}],
        backgroundColor: [
          'rgba(40, 167, 69, 0.8)',
          'rgba(255, 193, 7, 0.8)',
          'rgba(220, 53, 69, 0.8)'
        ],
        borderColor: [
          'rgba(40, 167, 69, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(220, 53, 69, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              var label = context.label || '';
              if (label) {
                label += ': ';
              }
              label += context.parsed;
              return label;
            }
          }
        }
      }
    }
  });
</script>
@endpush
