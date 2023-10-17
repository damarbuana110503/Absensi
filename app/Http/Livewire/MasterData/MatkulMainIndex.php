<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Matkul;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MatkulMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $jurusan = [];

    public $state = [];
    public $params = [
        'FK_MATKUL' => null,
        'FN_MATKUL' => null,

        'FK_JURUSAN' => null,
        'TEXT_JURUSAN' => null,

        'edit' => false,
    ];

    protected $listeners =[
        'selectedJurusan',
    ];

    public function mount()
    {
        $this->state = $this->params;
    }
    
    public function render()
    {
        $getData = Matkul::orderBy('FK_MATKUL', 'ASC')->paginate(5);

        return view('livewire.master-data.matkul-main-index', [
            'dataMatkul' => $getData
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
            $this->state['FK_MATKUL'] = $data['FK_MATKUL'];
            $this->state['FN_MATKUL'] = $data['FN_MATKUL'];
            
            if ($data['jurusan'] != null) {
                $this->jurusan = $data['jurusan'];
                $this->state['FK_JURUSAN'] = $data['FK_JURUSAN'];
                $this->state['TEXT_JURUSAN'] = $data['jurusan']['FK_JURUSAN'] . ' - ' . $data['jurusan']['FN_JURUSAN'];
            }
        }


    }

    public function openModalJurusan()
    {
        $this->emitTo('master-data.jurusan-modal-data', 'openModalJurusan', [
            'showProps' => 'show',
            'source' => 'master-data.matkul-main-index'
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

    public function createData()
    {
        $this->validate([
            'state.FK_MATKUL' => 'required|string|unique:matkuls,FK_MATKUL',
            'state.FN_MATKUL' => 'required|string',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',
        ]);

        DB::beginTransaction();
        try {
            $createData = Matkul::create([
                'FK_MATKUL' => $this->state['FK_MATKUL'],
                'FN_MATKUL' => $this->state['FN_MATKUL'],

                'FK_JURUSAN' => $this->state['FK_JURUSAN'],
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
            $getData = Matkul::where('FK_MATKUL', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FK_MATKUL' => 'required|string|exists:matkuls,FK_MATKUL',
            'state.FN_MATKUL' => 'required|string',

            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN'
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',


        ]);

        DB::beginTransaction();
        try {
            $getData = Matkul::where('FK_MATKUL', '=', $this->state['FK_MATKUL'])->firstOrFail();
            $updateData = $getData->update([
                'FN_MATKUL' => trim($this->state['FN_MATKUL']),

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
        try {
            $getData = Matkul::where('FK_MATKUL', '=', $id)->firstOrFail();

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
