<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block' : 'd-block' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-3"></span>
                        Form Dosen
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-danger px-3" wire:click="showFrom(false)">
                            <span class="fa fa-times mr-2"></span>
                            Tutup Formulir
                        </button>
                    </div>
                </div>

                <div class="card-body text-sm py-2">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FNO_KTP">No KTP : </label>
                                <input type="text" wire:model="state.FNO_KTP" name="no_ktp" id="no_ktp" class="form-control form-control-sm {{ $errors->has('state.FNO_KTP') ? 'is-invalid' : '' }}" placeholder="Masukan No KTP...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FNO_KTP') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FK_NIDN">Kode NIDN : </label>
                                <input type="text" wire:model="state.FK_NIDN" name="nidn" id="nidn" class="form-control form-control-sm {{ $errors->has('state.FK_NIDN') ? 'is-invalid' : '' }}" placeholder="Masukan NIM..." {{ $state['edit'] == true ? 'disabled':'' }} required>
                                <div class="invalid-feddback">
                                    {{ $errors->first('state.FK_NIDN') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FN_DOSEN">Nama Dosen : </label>
                                <input type="text" wire:model="state.FN_DOSEN" name="nama_dosen" id="nama_dosen" class="form-control form-control-sm {{ $errors->has('state.FN_DOSEN') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Mahsiswa..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_DOSEN') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="FK_KEL">Jenis Kelamin : </label>
                            <select name="kelamin" wire:model="state.FK_KEL" id="kelamin" class="form-control from-control-sm {{ $errors->has('state.FK_KEL') ? 'is-invalid':'' }}">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FK_KEL') }}
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FTMP_LAHIR">Tempat Lahir : </label>
                                <input type="text" wire:model="state.FTMP_LAHIR" name="tempat_lahir" id="tempat_lahir" class="form-control form-control-sm {{ $errors->has('state.FTMP_LAHIR') ? 'is-invalid' : '' }}" placeholder="Masukan Tempat Lahir..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FTMP_LAHIR') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="FTGL_LAHIR">Tanggal Lahir :</label>
                                    <input type="date" wire:model="state.FTGL_LAHIR" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm {{ $errors->has('state.FTGL_LAHIR') ? 'is-invalid':'' }}" required>
                                <div class="invalid-feedback">
                                {{ $errors->first('state.FTGL_LAHIR') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="FNO_TELP_HP">Nomor Telfon : </label>
                                <input type="text" wire:model="state.FNO_TELP_HP" name="no_telp" id="no_telp" class="form-control form-control-sm {{ $errors->has('state.FNO_TELP_HP') ? 'is-invalid':'' }}" placeholder="Masukan Nomor Telfon..." required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FNO_TELP_HP') }}
                            </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="FALAMAT">Alamat : </label>
                                <textarea wire:model="state.FALAMAT" name="alamat" id="alamat" cols="1" rows="1" class="form-control form-control-sm {{ $errors->has('state.FALAMAT') ? 'is-invalid':'' }}" placeholder="Masukan Alamat..."></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FALAMAT') }}
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="FK_AGAMA">Agama : </label>
                                <div class="float-right">
                                    <button class="badge badge-info px-3" wire:click="openModalAgama">
                                        Pilih Agama
                                    </button>
                                </div>
                                <input type="text" wire:model="state.TEXT_AGAMA" name="agama" id="agama" class="form-control form-control-sm {{ $errors->has('state.FK_AGAMA') ? 'is-invalid' : '' }}" placeholder="-- Pilihan Data Agama --" disabled required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FK_AGAMA') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
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
                                    Reset / Batalkan
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
                        Master Data Dosen
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showFrom(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Dosen   
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="align-middle py-2 px-2 text-center">No.</td>
                                <td class="align-middle py-2 px-2 text-center">No Ktp</td>
                                <td class="align-middle py-2 px-2 text-center">Kode NIDN</td>
                                <td class="align-middle py-2 px-2 text-center">Nama Dosen</td>
                                <td class="align-middle py-2 px-2 text-center">Jenis Kelamin</td>
                                <td class="align-middle py-2 px-2 text-center">No Telepon</td>
                                <td class="align-middle py-2 px-2 text-center">Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataDosen as $item )
                                <tr>
                                    <td class="align-middle px-2 py-2 text-center">{{ ($dataDosen->currentpage()-1) * $dataDosen->perpage() + $loop->index + 1 }}.</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FNO_KTP }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FK_NIDN }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FN_DOSEN }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FK_KEL }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FNO_TELP_HP }}</td>
                                    <td class="align-middle px-2 py-2 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-info px-3" wire:click="detailData('{{ $item->FK_NIDN }}')">
                                                <span class="fa fa-info"></span>
                                            </button>
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FK_NIDN }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FK_NIDN }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                
                            @endforelse
                            <tr>
                                <td colspan="7" class="text-center">Belum Ada Data Dosen</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @livewire('master-data.jurusan-modal-data')
    @livewire('master-data.agama-modal-data')
</div>
