<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block' : 'd-none' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-2"></span>
                        Form Mata Kuliah
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
                                <label for="FK_MATKUL">Kode Mata Kuliah : </label>
                                <input type="text" wire:model="state.FK_MATKUL" name="kode_matkul" id="kode_matkul" class="form-control form-control-sm {{ $errors->has('state.FK_MATKUL') ? 'is-invalid' : '' }}" placeholder="Masukan Kode Matkul..." {{ $state['edit'] == true ? 'disabled':'' }} required>
                                <div class="invalid-feddback">
                                    {{ $errors->first('state.FK_MATKUL') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FN_MATKUL">Nama Mata Kuliah : </label>
                                <input type="text" wire:model="state.FN_MATKUL" name="nama_matkul" id="nama_matkul" class="form-control form-control-sm {{ $errors->has('state.FN_MATKUL') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Matkul..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_MATKUL') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="from-group">
                                <label for="FK_JURUSAN">Jurusan : </label>
                                <div class="float-right">
                                    <button class="badge badge-info px-3" wire:click="openModalJurusan">
                                        Pilih Data Jurusan
                                    </button>
                                </div>
                                <input type="text" wire:model="state.TEXT_JURUSAN" name="jurusan" id="jurusan" class="form-control form-control-sm {{ $errors->has('state.FK_JURUSAN') ? 'is-invalid' : '' }}" placeholder="-- Pilihan Data Jurusan --" disabled required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_JURUSAN') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        @if ($state['edit'] == true)
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-block btn-success" wire:click="updateData">
                                    <span class="fa fa-check mr-2"></span>
                                    Simpan Perubahan
                                </button>
                            </div>
                        @else
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-sm btn-block btn-success" wire:click="createData">
                                    <span class="fa fa-check mr-2"></span>
                                    Buat Data
                                </button>
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-sm btn-block btn-danger">
                                    <span class="fa fa-undo mr-2"></span>
                                    Reset / Batal
                                </button>
                            </div>
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
                        Master Data Matkul
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Matkul
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle px-2 py-2 text-center">No.</th>
                                <th class="align-middle px-2 py-2 text-center">Kode Matkul</th>
                                <th class="align-middle px-2 py-2 text-center">Nama Matkul</th>
                                <th class="align-middle px-2 py-2 text-center">Jurusan</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataMatkul as $item )
                                <tr>
                                    <td class="align-middle px-2 py-2 text-center">{{ ($dataMatkul->currentpage()-1) * $dataMatkul->perpage() + $loop->index + 1 }}.</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FK_MATKUL }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FN_MATKUL }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->jurusan->FK_JURUSAN }}</td>
                                    <td class="align-middle px-2 py-2 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_MATKUL }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_MATKUL }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum Ada Data Matkul</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        {{ $dataMatkul->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @livewire('master-data.jurusan-modal-data')
</div>
