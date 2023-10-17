<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block' : 'd-none' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-3"></span>
                        Formulir Data Agama 
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
                            <div class="form-group">
                                <label for="FK_AGAMA">Kode Agama : </label>
                                <input type="text" wire:model="state.FK_AGAMA" name="kode_agama" id="kode_agama" class="form-control form-control-sm {{ $errors->has('state.FK_AGAMA') ? 'is-invalid' : '' }}" placeholder="Masukan Kode Agama..." {{ $state['edit'] == true ? 'disabled' : '' }} maxlength="1" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_AGAMA') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="FN_AGAMA">Nama Agama : </label>
                                <input type="text" wire:model="state.FN_AGAMA" name="nama_agama" id="nama_agama" class="form-control form-control-sm {{ $errors->has('state.FN_AGAMA') }}" placeholder="Masukan Nama Agama..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_AGAMA') }}
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
                                    Simpan Data Perubahan 
                                </button>
                            </div>
                        @else
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-success" wire:click="createData">
                                <span class="fa fa-check mr-2"></span>
                                Buat Data
                            </button>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-danger" wire:click="deleteData">
                                <span class="fa fa-undo mr-2"></span>
                                Reset / Batalkan 
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
                        Master Data Agama 
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Agama 
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle px-2 py-2 text-center">No.</th>
                                <th class="align-middle px-2 py-2 text-center">Kode Agama </th>
                                <th class="align-middle px-2 py-2 text-center">Nama Agama</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataAgama as $item )
                                <tr>
                                    <td class="align-middle px-2 py-2 text-center">{{ $loop->iteration }}.</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FK_AGAMA }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FN_AGAMA }}</td>
                                    <td class="align-middle px-2 py-2 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_AGAMA }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_AGAMA }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum Ada Data Agama</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
