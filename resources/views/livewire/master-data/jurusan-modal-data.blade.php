<div>
    <div wire:ignore.self class="modal fade" id="modal-jurusan">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" wire:click="$refresh">
                <span class="fa fa-table mr-3"></span>
                Daftar Data Jurusan
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="align-middle px-2 py-2 text-center" width="15%">Kode Jurusan</th>
                                    <th class="align-middle px-2 py-2 text-center">Nama Jurusan</th>
                                    <th class="align-middle px-2 py-2 text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dataJurusan as $item)
                                    <tr>
                                        <td class="align-middle px-2 py-1 text-center font-weight-bold">{{ $item->FK_JURUSAN }}</td>
                                        <td class="align-middle px-2 py-1 text-center">{{ $item->FN_JURUSAN }}</td>
                                        <td class="align-middle px-2 py-1 text-center">
                                            <button class="btn btn-xs btn-success px-3" wire:click="pilihJurusan('{{ $item->FK_JURUSAN }}')">
                                                <span class="fa fa-check mr-2"></span>
                                                Pilih Data 
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="align-middle px-2 py-2 text-center">Belum Ada Jurusan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <div class="float-right">
                {{ $dataJurusan->links() }}
            </div>
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
            Livewire.on('modal-jurusan', function(showValue) {
                $('#modal-jurusan').modal(showValue);
            });
        });
    </script>
@endpush