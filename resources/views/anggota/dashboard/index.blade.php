@extends('layouts.grim.index', ['title' => 'Dashboard Anggota', 'section_header' => 'Dashboard Anggota'])

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

/* Timeline Styles for Recent Activities */
.timeline {
  position: relative;
  padding-left: 20px;
}
.timeline::before {
  content: '';
  position: absolute;
  left: 15px;
  top: 0;
  bottom: 0;
  width: 2px;
  background: #e9ecef;
}
.timeline-item {
  position: relative;
  margin-bottom: 15px;
  padding-left: 40px;
}
.timeline-item .activity-icon {
  position: absolute;
  left: -30px;
  top: 0;
  width: 20px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  border-radius: 50%;
  font-size: 10px;
  border: 2px solid #fff;
  box-shadow: 0 0 0 2px transparent;
}
.timeline-item.approved .activity-icon {
  box-shadow: 0 0 0 2px #28a745;
}
.timeline-item.waiting .activity-icon {
  box-shadow: 0 0 0 2px #ffc107;
}
.timeline-item.rejected .activity-icon {
  box-shadow: 0 0 0 2px #dc3545;
}
.timeline-item .activity-content {
  background: #f8f9fa;
  padding: 8px 12px;
  border-radius: 8px;
  border-left: 4px solid #007bff;
  transition: all 0.3s ease;
}
.timeline-item:hover .activity-content {
  background: #e9ecef;
  transform: translateX(5px);
}
.timeline-item.approved .activity-content {
  border-left-color: #28a745;
}
.timeline-item.waiting .activity-content {
  border-left-color: #ffc107;
}
.timeline-item.rejected .activity-content {
  border-left-color: #dc3545;
}
.timeline-item .activity-title {
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 5px;
  color: #333;
}
.timeline-item .activity-time {
  font-size: 11px;
  color: #6c757d;
}
</style>

<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
      <div class="card-icon shadow-success bg-success">
        <i class="fas fa-check-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Disetujui</h4>
        </div>
        <div class="card-body">
          {{ count($book_approved) }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
      <div class="card-icon shadow-warning bg-warning">
        <i class="fas fa-clock"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Menunggu</h4>
        </div>
        <div class="card-body">
          {{ count($book_waiting) }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
      <div class="card-icon shadow-danger bg-danger">
        <i class="fas fa-times-circle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Ditolak</h4>
        </div>
        <div class="card-body">
          {{ count($book_rejected) }}
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card card-statistic-2 card-modern">
      <div class="card-icon shadow-info bg-info">
        <i class="fas fa-exclamation-triangle"></i>
      </div>
      <div class="card-wrap">
        <div class="card-header">
          <h4>Buku Terlambat</h4>
        </div>
        <div class="card-body">
          {{ count($overdue_books) }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-5 col-md-6 col-sm-12 mb-4">
    <div class="card card-modern">
      <div class="card-header">
        <h4>Aktivitas Terbaru</h4>
      </div>
      <div class="card-body" style="max-height: 300px; overflow-y: auto;">
        <div class="timeline">
          @forelse($recent_activities as $activity)
            <div class="timeline-item @if($activity->status == 1) approved @elseif($activity->status == 2) waiting @elseif($activity->status == 3) rejected @endif">
              <div class="activity-icon @if($activity->status == 1) bg-success @elseif($activity->status == 2) bg-warning @elseif($activity->status == 3) bg-danger @endif">
                @if($activity->status == 1)
                  <i class="fas fa-check"></i>
                @elseif($activity->status == 2)
                  <i class="fas fa-clock"></i>
                @elseif($activity->status == 3)
                  <i class="fas fa-times"></i>
                @endif
              </div>
              <div class="activity-content">
                <div class="activity-title">
                  @if($activity->status == 1)
                    Buku "{{ $activity->book->title }}" Disetujui
                  @elseif($activity->status == 2)
                    Buku "{{ $activity->book->title }}" Menunggu Persetujuan
                  @elseif($activity->status == 3)
                    Buku "{{ $activity->book->title }}" Ditolak
                  @endif
                </div>
                <div class="activity-time">{{ $activity->created_at->diffForHumans() }}</div>
              </div>
            </div>
          @empty
            <div class="text-center text-muted py-4">
              <i class="fas fa-inbox fa-2x mb-2"></i>
              <p>Tidak ada aktivitas terbaru.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-7 col-md-6 col-sm-12 mb-4">
    <div class="card shadow-sm border-0 rounded-lg">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Log Pengguna</h5>
        <div>
          <button type="button" class="btn btn-light btn-sm mr-2" id="refresh-logs">
            <i class="fas fa-sync-alt"></i> Refresh
          </button>
          <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#staticBackdrop">
            Lihat semua
          </button>
        </div>
      </div>
      <div class="card-body p-3" style="max-height: 400px; overflow-y: auto;">
        <ul class="list-unstyled mb-0" id="user-logs-list">
          @forelse($user_logs as $log)
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
@endsection

@push('modal')
@include('anggota.dashboard.modal.show')
@endpush

@push('js')
<script>
  // Refresh logs button handler
  document.getElementById('refresh-logs').addEventListener('click', function() {
    fetch('{{ route("anggota.dashboard.logs") }}')
      .then(response => response.json())
      .then(data => {
        const list = document.getElementById('user-logs-list');
        list.innerHTML = '';
        if (data.length === 0) {
          list.innerHTML = '<li class="text-center text-danger font-weight-bold text-uppercase">Data tidak ada!</li>';
          return;
        }
        data.forEach(log => {
          const li = document.createElement('li');
          li.className = 'media mb-3 p-2 rounded shadow-sm bg-light';
          li.innerHTML = `
            <img src="${log.user.image ? '{{ asset('') }}' + log.user.image : '{{ asset('public/assets/img/avatar/default.png') }}'}" alt="User Avatar" class="mr-3 rounded-circle" style="width: 48px; height: 48px; object-fit: cover;">
            <div class="media-body">
              <h6 class="mt-0 mb-1">${log.user.name}</h6>
              <small class="text-muted">IP: ${log.last_login_ip}</small><br>
              <small class="text-muted">${log.relative_time}</small>
            </div>
          `;
          list.appendChild(li);
        });
      })
      .catch(error => {
        console.error('Error fetching logs:', error);
      });
  });
</script>
@endpush
