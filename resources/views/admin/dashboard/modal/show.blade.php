<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Log Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Nama</th>
                <th>IP</th>
                <th>Pukul</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @forelse($login_logs as $login_log)
              <tr>
                <td>{{ $login_log->user->name }}</td>
                <td>{{ $login_log->last_login_ip }}</td>
                <td>{{ $login_log->time($login_log->last_login_time) }}</td>
                <td>{{ $login_log->indonesian_date_format($login_log->last_login_date) }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-danger font-weight-bold text-uppercase">Data tidak ada!</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
