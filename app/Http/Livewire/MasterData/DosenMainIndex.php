<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DosenMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $jurusan = [];
    public $agama = [];

    public $state = [];
    public $params = [
        'FNO_KTP' => null,
        'FK_NIDN' => null,
        'FN_DOSEN' => null,
        'FTMP_LAHIR' => null,
        'FTGL_LAHIR' => null,

        'FNO_TELP_HP' => null,
        'FALAMAT' => null,
        
        'FK_KEL' => null,
        

        'FK_JURUSAN' => null,
        'TEXT_JURUSAN' => null,

        'FK_AGAMA' => null,
        'TEXT_AGAMA' => null,

        'edit' => false,
    ];

    protected $listeners =[
        'selectedJurusan',
        'selectedAgama',
        
    ];

    public function mount()
    {
        $this->state = $this->params;
    }
    
    public function render()
    {
        $getData = Dosen::orderBy('FK_NIDN', 'ASC')->paginate(5);

        return view('livewire.master-data.dosen-main-index', [
            'dataDosen' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FNO_KTP'] = $data['FNO_KTP'];
            $this->state['FK_NIDN'] = $data['FK_NIDN'];
            $this->state['FN_DOSEN'] = $data['FN_DOSEN'];
            $this->state['FNO_KTP'] = $data['FNO_KTP'];
            $this->state['FTMP_LAHIR'] = $data['FTMP_LAHIR'];
            $this->state['FTGL_LAHIR'] = $data['FTGL_LAHIR'];
            $this->state['FNO_TELP_HP'] = $data['FNO_TELP_HP'];
            $this->state['FALAMAT'] = $data['FALAMAT'];
            $this->state['FK_KEL'] = $data['FK_KEL'];
        }

        if ($data['jurusan'] != null) {
            $this->jurusan = $data['jurusan'];
            $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
            $this->state['TEXT_JURUSAN'] = $data['jurusan']['FN_JURUSAN'];
        }

        if ($data['agama'] != null) {
            $this->agama = $data['agama'];
            $this->state['FK_AGAMA'] = $data['FK_AGAMA'];
            $this->state['TEXT_AGAMA'] = $data['agama']['FN_AGAMA'];
        }
    }

    public function openModalJurusan()
    {
        $this->emitTo('master-data.jurusan-modal-data', 'openModalJurusan', [
            'showProps' => 'show',
            'source' => 'master-data.dosen-main-index'
        ]);
    }
    
    public function selectedJurusan($data)
    {
        if ($data != null) {
            $this->reset('jurusan');
    
            $this->jurusan = $data;
            $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
            $this->state['TEXT_JURUSAN'] = $data['FK_JURUSAN']. ' - ' .$data['FN_JURUSAN'];
        }
    }
    
    public function openModalAgama()
    {
        $this->emitTo('master-data.agama-modal-data', 'openModalAgama', [
            'showProps' => 'show',
            'source' => 'master-data.dosen-main-index'
        ]);
    }
    
    public function selectedAgama($data)
    {
        if ($data != null) {
            $this->reset('agama');
    
            $this->jurusan = $data;
            $this->state['FK_AGAMA'] = $data['FK_AGAMA'];
            $this->state['TEXT_AGAMA'] = $data['FK_AGAMA'] . ' - ' . $data['FN_AGAMA'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FK_NIDN' => 'required|string|unique:dosens,FK_NIDN',
            'state.FN_DOSEN' => 'required|string',
            'state.FNO_KTP' => 'required|string',
            'state.FTMP_LAHIR' => 'required|string',
            'state.FTGL_LAHIR' => 'required|string',
            'state.FNO_TELP_HP' => 'required|string',
            'state.FALAMAT' => 'nullable|string',
            'state.FK_KEL' => 'required|string',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
            'state.FK_AGAMA' => 'required|exists:agamas,FK_AGAMA',

        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',

        ]);

        DB::beginTransaction();
        try {
            $createData = Dosen::create([
                'FNO_KTP' => trim($this->state['FNO_KTP']),
                'FK_NIDN' => trim( $this->state['FK_NIDN']),
                'FN_DOSEN' => trim( $this->state['FN_DOSEN']),
                'FTMP_LAHIR' => trim($this->state['FTMP_LAHIR']),
                'FTGL_LAHIR' => trim($this->state['FTGL_LAHIR']),
                'FNO_TELP_HP' => trim($this->state['FNO_TELP_HP']),
                'FK_KEL' => trim($this->state['FK_KEL']),
                'FK_JURUSAN' => trim($this->state['FK_JURUSAN']),
                'FK_AGAMA' => trim($this->state['FK_AGAMA']),
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
            $getData = Dosen::with([
                'jurusan',
                'agama',
            ])->where('FK_NIDN', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_NIDN' => 'required|string|exists:dosens,FK_NIDN',
            'state.FN_DOSEN' => 'required|string',
            'state.FNO_KTP' => 'required|string',
            'state.FTMP_LAHIR' => 'required|string',
            'state.FTGL_LAHIR' => 'required|string',
            'state.FNO_TELP_HP' => 'required|string',
            'state.FALAMAT' => 'nullable|string',
            'state.FK_KEL' => 'required|string',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
            'state.FK_AGAMA' => 'required|exists:agamas,FK_AGAMA',

        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',

        ]);

        DB::beginTransaction();
        try {
            $getData = Dosen::where('FK_NIDN', '=', $this->state['FK_NIDN'])->firstOrFail();
            $updateData = $getData->update([
                'FN_DOSEN' => trim($this->state['FN_DOSEN']),
                'FNO_KTP' => trim($this->state['FNO_KTP']),
                'FN_DOSEN' => trim( $this->state['FN_DOSEN']),
                'FTMP_LAHIR' => trim($this->state['FTMP_LAHIR']),
                'FTGL_LAHIR' => trim($this->state['FTGL_LAHIR']),
                'FNO_TELP_HP' => trim($this->state['FNO_TELP_HP']),
                'FK_KEL' => trim($this->state['FK_KEL']),
                'FK_JURUSAN' => trim($this->state['FK_JURUSAN']),
                'FK_AGAMA' => trim($this->state['FK_AGAMA']),
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
            $getData = Dosen::where('FK_NIDN', '=', $id)->firstOrFail();
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
