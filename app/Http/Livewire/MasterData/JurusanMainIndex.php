<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Jurusan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class JurusanMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FK_JURUSAN' => null,
        'FN_JURUSAN' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }
    public function render()
    {
        $getData = Jurusan::get();
        return view('livewire.master-data.jurusan-main-index', [
            'dataJurusan' => $getData
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
            $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
            $this->state['FN_JURUSAN'] = $data['FN_JURUSAN'];
        }

    }

    public function createData()
    {
        $this->validate([
            'state.FK_JURUSAN' => 'required|string|unique:jurusans,FK_JURUSAN',
            'state.FN_JURUSAN' => 'required|string',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
        ]);

        DB::beginTransaction();
        try {
            $createData = Jurusan::create([
                'FK_JURUSAN' => $this->state['FK_JURUSAN'],
                'FN_JURUSAN' => $this->state['FN_JURUSAN'],
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
            $getData = Jurusan::where('FK_JURUSAN', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_JURUSAN' => 'required|string|exists:jurusans,FK_JURUSAN',
            'state.FN_JURUSAN' => 'required|string',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',


        ]);

        DB::beginTransaction();
        try {
            $getData = Jurusan::where('FK_JURUSAN', '=', $this->state['FK_JURUSAN'])->firstOrFail();
            $updateData = $getData->update([
                'FN_JURUSAN' => trim($this->state['FN_JURUSAN'])
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
            $getData = Jurusan::where('FK_JURUSAN', '=', $id)->firstOrFail();

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
