<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block':'d-block' }}">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-3"></span>
                        Formulir Data Kelas
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-danger px-3" wire:click="showForm(false)">
                            <span class="fa fa-times mr-2"></span>
                            Tutup Formulir
                        </button>
                    </div>
                </div>

                <div class="card-body text-sm py-2">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label for="FK_KELAS">Kode Kelas : </label>
                            <input type="text" wire:model="state.FK_KELAS" name="kode_kelas" id="kode_kelas" class="form-control form-control-sm {{ $errors->has('state.FK_KELAS') ? 'is-invalid':'' }}" placeholder="Masukan Kode Kelas..." {{ $state['edit'] == true ? 'disabled':'' }}   required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FK_KELAS') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="FN_KELAS">Nama Kelas : </label>
                            <input type="text" wire:model="state.FN_KELAS" name="nama_kelas" id="nama_kelas" class="form-control form-control-sm {{ $errors->has('state.FN_KELAS') ? 'is-invalid':'' }}" placeholder="Masukan Nama Kelas..." required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FN_KELAS') }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="FKET">Keterangan : </label>
                            <textarea wire:model="state.FKET" name="keterangan" id="keterangan" cols="1" rows="1" class="form-control form-control-sm {{ $errors->has('state.FKET') }}" placeholder="Masukan Keterangan..."></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FKET') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card-footer">
                    <div class="row">
                        @if ($state['edit'] == true)
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-success" wire:click="updateData">
                                <span class="fa fa-check mr-2"></span>
                                Simpan Perubahan
                            </button>
                        </div>
                        @else
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-success" wire:click="createData">
                                <span class="fa fa-check mr-2"></span>
                                Buat Data Kelas
                            </button>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-danger" wire:click="showForm(false)">
                                <span class="fa fa-undo mr-2"></span>
                                Reset / Batalkan Input
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-table mr-3"></span>
                        Master Data Kelas
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Kelas
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle px-2 py-2 text-center">No.</th>
                                <th class="align-middle px-2 py-2 text-center">Kode Kelas</th>
                                <th class="align-middle px-2 py-2 text-center">Nama Kelas</th>
                                <th class="align-middle px-2 py-2 text-center">Keterangan</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataKelas as $item)
                                <tr>
                                    <td class="align-middle px-2 py-1 text-center">{{ ($dataKelas->currentpage()-1) * $dataKelas->perpage() + $loop->index + 1  }}.</td>
                                    <td class="align-middle px-2 py-1 text-center">{{ $item->FK_KELAS }}</td>
                                    <td class="align-middle px-2 py-1 text-center">{{ $item->FN_KELAS }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FKET }}</td>
                                    <td class="align-middle px-2 py-1 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_KELAS }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_KELAS }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td class="align-middle text-center" colspan="5">Belum Ada Data Kelas</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        {{ $dataKelas->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
