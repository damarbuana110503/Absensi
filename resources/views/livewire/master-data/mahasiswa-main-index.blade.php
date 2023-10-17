<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block' : 'd-block' }}">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-2"></span>
                        Form Mahsiswa
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
                                <label for="FNO_KTP">No KTP : </label>
                                <input type="text" wire:model="FNO_KTP" name="no_ktp" id="no_ktp" class="form-control form-control-sm {{ $errors->has('state.FNO_KTP') ? 'is-invalid' : '' }}" placeholder="Masukan No KTP...">
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FNO_KTP') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FNIM">NIM Mahasiswa : </label>
                                <input type="text" wire:model="state.FNIM" name="nim" id="nim" class="form-control form-control-sm {{ $errors->has('state.FNIM') ? 'is-invalid' : '' }}" placeholder="Masukan NIM..." {{ $state['edit'] == true ? 'disabled':'' }} required>
                                <div class="invalid-feddback">
                                    {{ $errors->first('state.FNIM') }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="FN_MAHASISWA">Nama Mahasiswa : </label>
                                <input type="text" wire:model="state.FN_MAHASISWA" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control form-control-sm {{ $errors->has('state.FN_MAHASISWA') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Mahsiswa..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_MAHASISWA') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="FK_KEL">Jenis Kelamin : </label>
                            <select name="kelamin" wire:model="state.FK_KEL" id="kelamin" class="form-control from-control-sm {{ $errors->has('FK_KEL') ? 'is-invalid':'' }}">
                                <option value="">- Pilih Jenis Kelamin -</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('FK_KEL') }}
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="FSTATUS_AKTIF">Status Mahasiswa : </label>
                            <select name="kelamin" wire:model="state.FSTATUS_AKTIF" id="kelamin" class="form-control from-control-sm {{ $errors->has('FSTATUS_AKTIF') ? 'is-invalid':'' }}">
                                <option value="">- Pilih Status -</option>
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('FSTATUS_AKTIF') }}
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
                                <label for="FTGL_LAHIR">Tanggal :</label>
                                    <input type="date" wire:model="state.FTGL_LAHIR" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm {{ $errors->has('state.FTGL_LAHIR') ? 'is-invalid':'' }}" required>
                                <div class="invalid-feedback">
                                {{ $errors->first('state.FTGL_LAHIR') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FASAL_SEKOLAH">Asal Sekaloh : </label>
                                <input type="text" wire:model="state.FASAL_SEKOLAH" name="asal_sekolah" id="asal_sekolah" class="form-control form-control-sm {{ $errors->has('state.FASAL_SEKOLAH') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Asal Sekolah..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FASAL_SEKOLAH') }}
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FN_AYAH">Nama Ayah : </label>
                                <input type="text" wire:model="state.FN_AYAH" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm {{ $errors->has('state.FN_AYAH') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Asal Sekolah..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_AYAH') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="FNO_TELP_AYAH">Nomor Telfon Ayah / Ibu : </label>
                                <input type="text" wire:model="state.FNO_TELP_AYAH" name="no_telp_ayah" id="no_telp_ayah" class="form-control form-control-sm {{ $errors->has('state.FNO_TELP_AYAH') ? 'is-invalid':'' }}" placeholder="Masukan Nomor Telfon Ayah / Ibu..." required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FNO_TELP_AYAH') }}
                            </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="FN_IBU">Nama Ibu : </label>
                                <input type="text" wire:model="state.FN_IBU" name="nama_ayah" id="nama_ayah" class="form-control form-control-sm {{ $errors->has('state.FN_IBU') ? 'is-invalid' : '' }}" placeholder="Masukan Nama Asal Sekolah..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FN_IBU') }}
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
{{-- modal data --}}
                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="FTHN_AJARAN">Tahun Ajaran : </label>
                                <div class="float-right">
                                    <button class="badge badge-info px-3" wire:click="openModalThnAjaran">
                                        Pilih Tahun Ajaran
                                    </button>
                                </div>
                                <input type="text" wire:model="state.TEXT_THN-AJARAN" name="tahun_ajaran" id="thn_ajaran" class="form-control form-control-sm {{ $errors->has('state.FTHN_AJARAN') ? 'is-invalid' : '' }}" placeholder="-- Pilihan Data Tahun Ajaran --" disabled required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FTHN_AJARAN') }}
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
{{-- modal data --}}
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
                                <th class="align-middle px-2 py-2 text-center">No KTP</th>
                                <th class="align-middle px-2 py-2 text-center">NIM Mahasiswa</th>
                                <th class="align-middle px-2 py-2 text-center">Nama Mahasiswa</th>
                                <th class="align-middle px-2 py-2 text-center">Jenis Kelamin</th>
                                <th class="align-middle px-2 py-2 text-center">Status Mahasiswa</th>
                                <th class="align-middle px-2 py-2 text-center">Tempat Lahir</th>
                                <th class="align-middle px-2 py-2 text-center">Tanggal</th>
                                <th class="align-middle px-2 py-2 text-center">Asal Sekolah</th>
                                <th class="align-middle px-2 py-2 text-center">Nomor Telfon</th>
                                <th class="align-middle px-2 py-2 text-center">Nama Ayah</th>
                                <th class="align-middle px-2 py-2 text-center">No telfon Ayah / Ibu</th>
                                <th class="align-middle px-2 py-2 text-center">Nama Ibu</th>
                                <th class="align-middle px-2 py-2 text-center">Alamat</th>
                                <th class="align-middle px-2 py-2 text-center">Tahun Ajaran</th>
                                <th class="align-middle px-2 py-2 text-center">Agama</th>
                                <th class="align-middle px-2 py-2 text-center">Jurusan</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataMahasiswa as $item )
                                <tr>
                                    <td class="align-middle px-2 py-2 text-center">{{ ($dataMahasiswa->currentpage()-1) * $dataMahasiswa->perpage() + $loop->index + 1 }}.</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FNO_KTP }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FNIM }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->FN_MAHASISWA }}</td>
                                    {{-- <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item-> }}</td> --}}
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->thn_ajaran->FTHN_AJARAN }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->agama->FK_AGAMA }}</td>
                                    <td class="align-middle px-2 py-2 text-center">{{ $item->jurusan->FK_JURUSAN }}</td>
                                    <td class="align-middle px-2 py-2 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FNIM }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FNIM }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="18" class="text-center">Belum Ada Data Mahsiswa</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        {{ $dataMahasiswa->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    @livewire('master-data.jurusan-modal-data')
</div>

