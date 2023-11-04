<div>
    <div wire:ignore.self class="modal fade" id="mahasiswa-modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>No KTP</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FNO_KTP'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FNIM'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Mahasiswa</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FN_MAHASISWA'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td class="text-center">:</td>
                        <td>
                            @if (isset($mahasiswa['FK_KEL']))
                                @switch($mahasiswa['FK_KEL'])
                                    @case('L')
                                        Laki - Laki
                                        @break
                                        @case('P')
                                            Peremepuan
                                        @break
                                        @case('T')
                                            Teuing
                                        @break
                                    @default
                                        -
                                @endswitch
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FTMP_LAHIR'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FTGL_LAHIR'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['agama']['FN_AGAMA'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FK_JURUSAN'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tahun Ajaran</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FTHN_AJARAN'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Status Aktif</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FSTATUS_AKTIF'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FASAL_SEKOLAH'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No Telepon</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FNO_TELP_HP'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ayah</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FN_AYAH'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ibu</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FN_IBU'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FALAMAT'] ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No Telepon Orang</td>
                        <td class="text-center">:</td>
                        <td>{{ $mahasiswa['FNO_TELP_AYAH'] ?? '-' }}</td>
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
                $('#mahasiswa-modal-detail').modal(show);
            });
        });
    </script>
@endpush
