<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class JadwalMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $jurusan = [];
    public $matkul = [];
    public $dosen = [];

    public $state = [];
    public $params = [
        'state.FK_JADWAL' => null,

        'state.FK_MATKUL' => null,
        'state.TEXT_MATKUL' => null,

        'state.FK_NIDN' => null,
        'state.TEXT_DOSEN' => null,

        'state.FK_JURUSAN' => null,
        'state.TEXT_JURUSAN' => null,

        'state.FTGL' => null,
        'state.FJAM_MULAI' => null,
        'state.FJAM_KELUAR' => null,
        'state.FSTATUS_JADWAL' => null,

        'edit' => false,
    ];

    protected $listeners =[
        'selectedJurusan',
        'selectedMatkul',
        'selectedDosen',
    ];


    public function mount()
    {
        $this->state = $this->params;
    }
    
    public function render()
    {
        $getData = Jadwal::orderBy('FK_JADWAL', 'ASC')->paginate(5);

        return view('livewire.master-data.jadwal-main-index', [
            'dataJadwal' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->resetErrorBag();
        $this->reset('state');
        $this->state = $this->params;
        $this->form = $show;
        // dd($data);
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_JADWAL'] = $data['FK_JADWAL'];
            $this->state['FTGL'] = $data['FTGL'];
            $this->state['FJAM_MULAI'] = $data['FJAM_MULAI'];
            $this->state['FJAM_KELUAR'] = $data['FJAM_KELUAR'];
            $this->state['FSTATUS_JADWAL'] = $data['FSTATUS_JADWAL'];
            
            if ($data['jurusan'] != null) {
                $this->jurusan = $data['jurusan'];
                $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
                $this->state['TEXT_JURUSAN'] = $data['jurusan']['FK_JURUSAN'];
            }

            if ($data['dosen'] != null) {
                $this->dosen = $data['dosen'];
                $this->state['FK_NIDN'] = $data['FK_NIDN'];
                $this->state['TEXT_DOSEN'] = $data['dosen']['FN_DOSEN'];
            }

            if ($data['matkul'] != null) {
                $this->matkul = $data['matkul'];
                $this->state['FK_MATKUL'] = $data['FK_MATKUL'];
                $this->state['TEXT_MATKUL'] = $data['matkul']['FN_MATKUL'];
            }
        }
}

    public function openModalJurusan()
    {
        $this->emitTo('master-data.jurusan-modal-data', 'openModalJurusan', [
            'showProps' => 'show',
            'source' => 'master-data.jadwal-main-index'
        ]);
    }

    public function selectedJurusan($data)
    {
        if ($data != null) {
            $this->reset('jurusan');

            $this->jurusan = $data;
            $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
            $this->state['TEXT_JURUSAN'] = $data['FK_JURUSAN'] . ' - ' . $data['FN_JURUSAN'];
        }
    }

    public function openModalDosen()
    {
        $this->emitTo('master-data.dosen-modal-data', 'openModalDosen', [
            'showProps' => 'show',
            'source' => 'master-data.jadwal-main-index'
        ]);
    }

    public function selectedDosen($data)
    {
        if ($data != null) {
            $this->reset('dosen');

            $this->dosen = $data;
            $this->state['FK_NIDN'] = $data['FK_NIDN'];
            $this->state['TEXT_DOSEN'] = $data['FK_NIDN'] . ' - ' . $data['FN_DOSEN'];
        }
    }

    public function openModalMatkul()
    {
        $this->emitTo('master-data.matkul-modal-data', 'openModalMatkul', [
            'showProps' => 'show',
            'source' => 'master-data.jadwal-main-index'
        ]);
    }

    public function selectedMatkul($data)
    {
        if ($data != null) {
            $this->reset('matkul');

            $this->matkul = $data;
            $this->state['FK_MATKUL'] = $data['FK_MATKUL'];
            $this->state['TEXT_MATKUL'] = $data['FK_MATKUL'] . ' - ' . $data['FN_MATKUL'];
        }
    }



    public function createData()
    {
        $this->validate([
            'state.FK_JADWAL' => 'required|string|unique:jadwals,FK_JADWAL',
            'state.FTGL' => 'required|string',
            'state.FJAM_MULAI' => 'required|string',
            'state.FJAM_KELUAR' => 'required|string',
            'state.FSTATUS_JADWAL' => 'required|string',
            'state.FK_MATKUL' => 'required|exists:matkuls,FK_MATKUL',
            'state.FK_NIDN' => 'required|exists:dosens,FK_NIDN',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
            
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',


        ]);

        DB::beginTransaction();

        try {
            $createData = Jadwal::create([
                'FK_JADWAL' => trim( $this->state['FK_JADWAL']),
                'FTGL' => trim($this->state['FTGL']),
                'FJAM_MULAI' => trim($this->state['FJAM_MULAI']),
                'FJAM_KELUAR' => trim($this->state['FJAM_KELUAR']),
                'FSTATUS_JADWAL' => trim($this->state['FSTATUS_JADWAL']),
                'FK_MATKUL' => trim($this->state['FK_MATKUL']),
                'FK_NIDN' => trim($this->state['FK_NIDN']),
                'FK_JURUSAN' => trim($this->state['FK_JURUSAN']),
                
            ]);

            DB::commit();
            $this->emit('success', 'Data Berhasil di-Tambahkan !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }

    public function editData($id)
    {
        try {
            $getData = Jadwal::with([
                'matkul',
                'jurusan',
                'dosen',
            ])->where('FK_JADWAL', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_JADWAL' => 'required|string|exists:jadwals,FK_JADWAL',
            'state.FTGL' => 'required|string',
            'state.FJAM_MULAI' => 'required|string',
            'state.FJAM_KELUAR' => 'required|string',
            'state.FSTATUS_JADWAL' => 'required|string',
            'state.FK_MATKUL' => 'required|exists:matkuls,FK_MATKUL',
            'state.FK_NIDN' => 'required|exists:dosens,FK_NIDN',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',

        ]);

        DB::beginTransaction();
        try {
            $getData = Jadwal::where('FK_JADWAL', '=', $this->state['FK_JADWAL'])->firstOrFail();
            $updateData = $getData->update([
                'FTGL' => trim($this->state['FTGL']),
                'FJAM_MULAI' => trim($this->state['FJAM_MULAI']),
                'FJAM_KELUAR' => trim($this->state['FJAM_KELUAR']),
                'FSTATUS_JADWAL' => trim($this->state['FSTATUS_JADWAL']),
                'FK_MATKUL' => trim($this->state['FK_MATKUL']),
                'FK_NIDN' => trim($this->state['FK_NIDN']),
                'FK_JURUSAN' => trim($this->state['FK_JURUSAN']),                
            ]);

            DB::commit();
            $this->emit('info', 'Informasi Perubahan Data di-Simpan !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }

    }

    public function deleteData($id)
    {
        DB::beginTransaction();

        try {
            $getData = Jadwal::where('FK_JADWAL', '=', $id)->firstOrFail();
            $deleteData = $getData->delete();

            DB::commit();
            $this->emit('warning', 'Data di-Hapus !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->emit('error', 'Terjasi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
}
