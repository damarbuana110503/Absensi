<div>
  <div wire:ignore.self class="modal fade" id="dosen-modal-detail">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">Detail Dosen</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <table class="table table-bordered">
                <tr>
                  <td>No KTP</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FNO_KTP'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Kode NIDN</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FK_NIDN'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Nama Dosen</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FN_DOSEN'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FK_KEL'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Tempat Lahir</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FTMP_LAHIR'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Tanggal Lahir</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FTGL_LAHIR'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Nomor Telepon HP</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FNO_TELP_HP'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FALAMAT'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Agama</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FK_AGAMA'] ?? '-' }}</td>
                </tr>
                <tr>
                  <td>Jurusan</td>
                  <td class="text-center">:</td>
                  <td>{{ $dosen['FK_JURUSAN'] ?? '-' }}</td>
                </tr>
              </table>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
          </div>
      </div>
      <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
</div>

@push('script')
  <script>
      $(document).ready(function () {
          Livewire.on('open-modal-detail', function (show){
              $('#dosen-modal-detail').modal(show);
          });
      });
  </script>
@endpush
