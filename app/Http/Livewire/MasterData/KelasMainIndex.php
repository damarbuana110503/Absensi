<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class KelasMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FK_KELAS' => null,
        'FN_KELAS' => null,
        'FKET' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Kelas::orderBy('FK_KELAS', 'ASC')->paginate(5);

        return view('livewire.master-data.kelas-main-index', [
            'dataKelas' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_KELAS'] = $data['FK_KELAS'];
            $this->state['FN_KELAS'] = $data['FN_KELAS'];
            $this->state['FKET'] = $data['FKET'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FK_KELAS' => 'required|string|unique:kelas,FK_KELAS',
            'state.FN_KELAS' => 'required|string',
            'state.FKET' => 'nullable|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',

        ]);

        DB::beginTransaction();
        try {
            $createData = Kelas::create([
                'FK_KELAS' => trim( $this->state['FK_KELAS']),
                'FN_KELAS' => trim( $this->state['FN_KELAS']),
                'FKET' => trim($this->state['FKET']),
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
            $getData = Kelas::where('FK_KELAS', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_KELAS' => 'required|string|exists:kelas,FK_KELAS',
            'state.FN_KELAS' => 'required|string',
            'state.FKET' => 'nullable|string',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',

        ]);

        DB::beginTransaction();
        try {
            $getData = Kelas::where('FK_KELAS', '=', $this->state['FK_KELAS'])->firstOrFail();
            $updateData = $getData->update([
                'FN_KELAS' => trim($this->state['FN_KELAS']),
                'FKET' => trim($this->state['FKET']),
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
            $getData = Kelas::where('FK_KELAS', '=', $id)->firstOrFail();
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
