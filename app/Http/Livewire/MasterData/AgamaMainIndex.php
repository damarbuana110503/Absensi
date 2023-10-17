<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Agama;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AgamaMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FK_AGAMA' => null,
        'FN_AGAMA' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = Agama::get();
        return view('livewire.master-data.agama-main-index', [
            'dataAgama' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->resetErrorBag();
        $this->reset('state');
        $this->state = $this->params;
        $this->form = $show;

        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FK_AGAMA'] = $data['FK_AGAMA'];
            $this->state['FN_AGAMA'] = $data['FN_AGAMA'];
        }

    }

    public function createData()
    {
        $this->validate([
            'state.FK_AGAMA' => 'required|string|unique:agamas,FK_AGAMA',
            'state.FN_AGAMA' => 'required|string',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
        ]);

        DB::beginTransaction();
        try {
            $createData = Agama::create([
                'FK_AGAMA' => $this->state['FK_AGAMA'],
                'FN_AGAMA' => $this->state['FN_AGAMA'],
            ]);

            DB::commit();
            $this->emit('success', 'Data Sudah Disimpan !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function editData($id)
    {
        try {
            $getData = Agama::where('FK_AGAMA', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_AGAMA' => 'required|string|exists:agamas,FK_AGAMA',
            'state.FN_AGAMA' => 'required|string',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',


        ]);

        DB::beginTransaction();
        try {
            $getData = Agama::where('FK_AGAMA', '=', $this->state['FK_AGAMA'])->firstOrFail();
            $updateData = $getData->update([
                'FN_AGAMA' => trim($this->state['FN_AGAMA'])
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
        try {
            $getData = Agama::where('FK_AGAMA', '=', $id)->firstOrFail();

            $deleteData = $getData->delete();
            DB::commit();
            $this->emit('warning', 'Data Sudah Di-Hapus !');
            $this->showForm(false);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
