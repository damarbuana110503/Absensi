<div>
    <div class="row">
        <div class="col-12 {{ $form == true ? 'd-block':'d-none' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-2"></span>
                        form Jadwal
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
                                <label for="FK_JADWAL">Kode Jadwal : </label>
                                <input type="text" wire:model="state.FK_JADWAL" name="jadwal" id="jadwal" class="form-control form-control-sm {{ $errors->has('state.FK_JADWAL') ? 'is-invalid':'' }}" placeholder="Masukan Kode Jadwal..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_JADWAL') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggal">Tanggal :</label>
                                    <input type="date" wire:model="state.FTGL" name="tanggal" id="tanggal" class="form-control form-control-sm {{ $errors->has('state.FTGL') ? 'is-invalid':'' }}" required>
                                <div class="invalid-feedback">
                                {{ $errors->first('state.FTGL') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="mulai">Jam Masuk : </label>
                                <input type="time" wire:model="state.FJAM_MULAI" name="mulai" id="mulai" class="form-control form-control-sm {{ $errors->has('state.FJAM_MULAI') ? 'is-invalid':'' }}" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FJAM_MULAI') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="FJAM_KELUAR">Jam Keluar : </label>
                                <input type="time" wire:model="state.FJAM_KELUAR" name="mulai" id="mulai" class="form-control form-control-sm {{ $errors->has('state.FJAM_KELUAR') ? 'is-invalid':'' }}" required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FJAM_KELUAR') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FSTATUS_JADWAL">Status : </label>
                                <input type="datetime" wire:model="state.FSTATUS_JADWAL" name="mulai" id="mulai" class="form-control form-control-sm {{ $errors->has('state.FSTATUS_JADWAL') ? 'is-invalid':'' }}" placeholder="Masukan Status Jadwal..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FSTATUS_JADWAL') }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FK_NIDN">Dosen : </label>
                                <div class="float-right">
                                    <button class="badge badge-info px-3" wire:click="openModalDosen">
                                        Pilih Data Dosen
                                    </button>
                                </div>
                                <input type="text" wire:model="state.TEXT_DOSEN" name="dosen" id="dosen" class="form-control form-control-sm {{ $errors->has('state.FK_NIDN') ? 'is-invalid' : '' }}" placeholder="-- Pilihan Data Dosen --" disabled required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_NIDN') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FK_MATKUL">Matkul : </label>
                                <div class="float-right">
                                    <button class="badge badge-info px-3" wire:click="openModalMatkul">
                                        Pilih Data Matkul
                                    </button>
                                </div>
                                <input type="text" wire:model="state.TEXT_MATKUL" name="matkul" id="matkul" class="form-control form-control-sm {{ $errors->has('state.FK_MATKUL') ? 'is-invalid' : '' }}" placeholder="-- Pilihan Data Matkul --" disabled required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_MATKUL') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        @if ($state['edit'] == true)
                        <div class="col-md-3">
                            <div class="form-group">
                                <button class="btn btn-sm btn-block btn-success" wire:click="updateData">
                                    <span class="fa fa-check mr-2"></span>
                                    Simpan Perubahan 
                                </button>
                            </div>
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
                        Data Jadwal
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Jadwal
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle px-2 py-2 text-center">No.</th>
                                <th class="align-middle px-2 py-2 text-center">Kode Jadwal</th>
                                <th class="align-middle px-2 py-2 text-center">Tgl</th>
                                <th class="align-middle px-2 py-2 text-center">Jam Masuk</th>
                                <th class="align-middle px-2 py-2 text-center">Jam Keluar</th>
                                <th class="align-middle px-2 py-2 text-center">Status</th>
                                <th class="align-middle px-2 py-2 text-center">Jurusan</th>
                                <th class="align-middle px-2 py-2 text-center">Dosen</th>
                                <th class="align-middle px-2 py-2 text-center">Matkul</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataJadwal as $item)
                            <tr>
                                <td class="align-middle px-2 py-2 text-center">
                                    {{ ($dataMatkul->currentpage()-1) * $dataMatkul->perpage() + $loop->index + 1 }}.
                                </td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->FK_JADWAL }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->matkul->FN_MATKUL }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->dosen->FN_DOSEN }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->jurusan->FN_JURUSAN }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->FTGL }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->FJAM_MULAI }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->FJAM_KELUAR }}</td>
                                <td class="align-middle px-2 py-2 text-center">{{ $item->FSTATUS_JADWAL }}</td>                                
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Belum Ada Jadwal</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @livewire('master-data.jurusan-modal-data')
    @livewire('master-data.dosen-modal-data')
    @livewire('master-data.matkul-modal-data')
</div>
