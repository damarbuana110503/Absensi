<?php

namespace App\Http\Livewire\MasterData;

use App\Models\ThnAjaran;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ThnAjaranMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $state = [];
    public $params = [
        'FTHN_AJARAN' => null,
        'FBIAYA_SPP' => null,
        'FBIAYA_DSP' => null,

        'edit' => false,
    ];

    public function mount()
    {
        $this->state = $this->params;
    }

    public function render()
    {
        $getData = ThnAjaran::orderBy('FTHN_AJARAN', 'ASC')->paginate(5);

        return view('livewire.master-data.thn-ajaran-main-index', [
            'dataThnAjaran' => $getData
        ]);
    }

    public function showForm($show, $data = [])
    {
        $this->reset('state');
        $this->state = $this->params;

        $this->form = $show;
        if ($data != null) {
            $this->state['edit'] = true;
            $this->state['FTHN_AJARAN'] = $data['FTHN_AJARAN'];
            $this->state['FBIAYA_SPP'] = $data['FBIAYA_SPP'];
            $this->state['FBIAYA_DSP'] = $data['FBIAYA_DSP'];
        }
    }

    public function createData()
    {
        $this->validate([
            'state.FTHN_AJARAN' => 'required|string|unique:thn_ajarans,FTHN_AJARAN',
            'state.FBIAYA_SPP' => 'required|numeric|min:0',
            'state.FBIAYA_DSP' => 'required|numeric|min:0',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',

        ]);

        DB::beginTransaction();
        try {
            $createData = ThnAjaran::create([
                'FTHN_AJARAN' => trim( $this->state['FTHN_AJARAN']),
                'FBIAYA_SPP' => trim( $this->state['FBIAYA_SPP']),
                'FBIAYA_DSP' => trim($this->state['FBIAYA_DSP']),
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
            $getData = ThnAjaran::where('FTHN_AJARAN', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    
    }

    public function updateData()
    {
        $this->validate([
            'state.FTHN_AJARAN' => 'required|string|exists:thn_ajarans,FTHN_AJARAN',
            'state.FBIAYA_SPP' => 'required|numeric|min:0',
            'state.FBIAYA_DSP' => 'required|numeric|min:0',
        ], [
            'required' => 'Data / Input Tidak Boleh Kosong !',
            'unique' => 'Data / Input Dengan Data Tersebut Sudah Ada !',
            'string' => 'Input Harus Berupa Alphanumerik',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',

        ]);

        DB::beginTransaction();
        try {
            $getData = ThnAjaran::where('FTHN_AJARAN', '=', $this->state['FTHN_AJARAN'])->firstOrFail();
            $updateData = $getData->update([
                'FBIAYA_SPP' => trim($this->state['FBIAYA_SPP']),
                'FBIAYA_DSP' => trim($this->state['FBIAYA_DSP']),
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
            $getData = ThnAjaran::where('FTHN_AJARAN', '=', $id)->firstOrFail();
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
