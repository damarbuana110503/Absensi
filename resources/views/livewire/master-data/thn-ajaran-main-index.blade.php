<div>
    <div class="row">
        <div class="col-12 {{ $form ? 'd-block':'d-block' }}">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h4 class="card-title">
                        <span class="fa fa-edit mr-3"></span>
                        Formulir Data Tahun Ajaran
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
                            <label for="FTHN_AJARAN">Kode Tahun Ajaran : </label>
                            <input type="text" wire:model="state.FTHN_AJARAN" name="kode_kelas" id="kode_kelas" class="form-control form-control-sm {{ $errors->has('state.FTHN_AJARAN') ? 'is-invalid':'' }}" placeholder="Masukan Kode Tahun Ajaran..." {{ $state['edit'] == true ? 'disabled':'' }}   required>
                            <div class="invalid-feedback">
                                {{ $errors->first('state.FTHN_AJARAN') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FBIAYA_SPP">Biaya SPP : </label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">Rp.</span>
                                </div>
                                <input type="number" wire:model="state.FBIAYA_SPP" name="biaya_spp" id="biaya_spp" class="form-control form-control-sm {{ $errors->has('state.FBIAYA_SPP') ? 'is-invalid':'' }}" placeholder="Masukan Biaya SPP..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FBIAYA_SPP') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="FBIAYA_DSP">Biaya DSP : </label>
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text font-weight-bold">Rp.</span>
                                </div>
                                <input type="number" wire:model="state.FBIAYA_DSP" name="biaya_dsp" id="biaya_dsp" class="form-control form-control-sm {{ $errors->has('state.FBIAYA_DSP') ? 'is-invalid':'' }}" placeholder="Masukan Biaya DSP..." required>
                                <div class="invalid-feedback">
                                    {{ $errors->first('state.FBIAYA_DSP') }}
                                </div>
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
                        Master Data Tahun Ajaran
                    </h4>

                    <div class="card-tools">
                        <button class="btn btn-xs btn-success px-3" wire:click="showForm(true)">
                            <span class="fa fa-plus mr-2"></span>
                            Tambah Data Tahun Ajaran
                        </button>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="align-middle px-2 py-2 text-center">No.</th>
                                <th class="align-middle px-2 py-2 text-center">Kode Tahun Ajaran</th>
                                <th class="align-middle px-2 py-2 text-center">Biaya SPP</th>
                                <th class="align-middle px-2 py-2 text-center">Biaya DSP</th>
                                <th class="align-middle px-2 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($dataThnAjaran as $item)
                                <tr>
                                    <td class="align-middle px-2 py-1 text-center">{{ ($dataThnAjaran->currentpage()-1) * $dataThnAjaran->perpage() + $loop->index + 1  }}.</td>
                                    <td class="align-middle px-2 py-1 text-center">{{ $item->FTHN_AJARAN }}</td>
                                    <td class="align-middle px-2 py-1 text-center">{{ $item->FBIAYA_SPP }}</td>
                                    <td class="align-middle px-2 py-1 text-center">{{ $item->FBIAYA_DSP }}</td>
                                    <td class="align-middle px-2 py-1 text-center">
                                        <div class="btn-group">
                                            <button class="btn btn-xs btn-warning px-3" wire:click="editData('{{ $item->FTHN_AJARAN }}')">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                            <button class="btn btn-xs btn-danger px-3" wire:click="deleteData('{{ $item->FTHN_AJARAN }}')">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td class="align-middle text-center" colspan="s">Belum Ada Data Tahun Ajaran</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="float-right">
                        {{ $dataThnAjaran->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
