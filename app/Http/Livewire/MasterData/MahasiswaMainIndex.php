<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MahasiswaMainIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $form = false;

    public $jurusan = [];

    public $state = [];
    public $params = [
        'FNO_KTP' => null,
        'FNIM' => null,
        'FN_MAHASISWA' => null,
        'FTMP_LAHIR' => null,
        'FTGL_LAHIR' => null,

        'FASAL_SEKOLAH' => null,
        'FNO_TELP_HP' => null,
        'FN_AYAH' => null,
        'FNO_TELP_AYAH' => null,
        'FN_IBU' => null,
        'FALAMAT' => null,
        
        'FK_KEL' => null,
        'FSTATUS_AKTIF' => null,

        'FK_JURUSAN' => null,
        'TEXT_JURUSAN' => null,

        'FTHN_AJARAN' => null,
        'TEXT_THN-AJARAN' => null,

        'FK_AGAMA' => null,
        'TEXT_AGAMA' => null,

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
        $getData = Mahasiswa::orderBy('FNIM', 'ASC')->paginate(5);

        return view('livewire.master-data.mahasiswa-main-index', [
            'dataMahasiswa' => $getData
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
            $this->state['FNIM'] = $data['FNIM'];
            $this->state['FN_MAHASISWA'] = $data['FN_MAHASISWA'];
            
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
            'state.FNIM' => 'required|string|unique:mahasiswas,FNIM',
            'state.FNO_KTP' => 'required',
            'state.FN_MAHASISWA' => 'required',
            'state.FK_KEL' => 'required',
            'state.FTMP_LAHIR' => 'required',
            'state.FTGL_LAHIR' => 'required',
            'state.FSTATUS_AKTIF' => 'required',
            'state.FASAL_SEKOLAH' => 'required',
            'state.FNO_TELP_HP' => 'required',
            'state.FN_AYAH' => 'required',
            'state.FN_IBU' => 'required',
            'state.FALAMAT' => 'required',
            'state.FNO_TELP_AYAH' => 'required',
            'state.FN_MATKUL' => 'required|string',
            'state.FK_AGAMA' => 'required|exists:agamas,FK_AGAMA',
            'state.FTHN_AJARAN' => 'required|exists:thn_ajarans,FTHN_AJARAN',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN',
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',
        ]);

        DB::beginTransaction();
        try {
            $createData = Mahasiswa::create([
                'FNIM' => $this->state['FNIM'],
                'FNO_KTP'=> $this->state['FNO_KTP'],
                'FNIM'=> $this->state['FNIM'],
                'FN_MAHASISWA'=> $this->state['FN_MAHASISWA'],
                'FK_KEL'=> $this->state['FK_KEL'],
                'FTMP_LAHIR'=> $this->state['FTMP_LAHIR'],
                'FTGL_LAHIR'=> $this->state['FTGL_LAHIR'],
                'FSTATUS_AKTIF'=> $this->state['FSTATUS_AKTIF'],
                'FASAL_SEKOLAH'=> $this->state['FASAL_SEKOLAH'],
                'FNO_TELP_HP'=> $this->state['FNO_TELP_HP'],
                'FN_AYAH'=> $this->state['FN_AYAH'],
                'FN_IBU'=> $this->state['FN_IBU'],
                'FALAMAT'=> $this->state['FALAMAT'],
                'FNO_TELP_AYAH'=> $this->state['FNO_TELP_AYAH'],
                'FK_AGAMA'=> $this->state['FK_AGAMA'],
                'FTHN_AJARAN'=> $this->state['FTHN_AJARAN'],
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
            $getData = Mahasiswa::where('FNIM', '=', $id)->firstOrFail();

            $this->showForm(true, $getData->toArray());
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }

    public function updateData()
    {
        $this->validate([
            'state.FNIM' => 'required|string|exists:mahasiswas,FNIM',
            'state.FNO_KTP' => 'required',
            'state.FN_MAHASISWA' => 'required',
            'state.FK_KEL' => 'required',
            'state.FTMP_LAHIR' => 'required',
            'state.FTGL_LAHIR' => 'required',
            'state.FSTATUS_AKTIF' => 'required',
            'state.FASAL_SEKOLAH' => 'required',
            'state.FNO_TELP_HP' => 'required',
            'state.FN_AYAH' => 'required',
            'state.FN_IBU' => 'required',
            'state.FALAMAT' => 'required',
            'state.FNO_TELP_AYAH' => 'required',
            'state.FN_MATKUL' => 'required|string',
            'state.FK_AGAMA' => 'required|exists:agamas,FK_AGAMA',
            'state.FTHN_AJARAN' => 'required|exists:thn_ajarans,FTHN_AJARAN',
            'state.FK_JURUSAN' => 'required|exists:jurusans,FK_JURUSAN'
        ], [
            'required' => 'Input Tidak Boleh Kosong !',
            'string' => 'Input Harus Berupa Alphanumerik !',
            'unique' => 'Input Sudah Ada, Silakan Pilih Ulang !',
            'exists' => 'Data Tidak Valid ! Silahkan Pilih Ulang Data !',


        ]);

        DB::beginTransaction();
        try {
            $getData = Mahasiswa::where('FNIM', '=', $this->state['FNIM'])->firstOrFail();
            $updateData = $getData->update([
                'FN_MATKUL' => trim($this->state['FN_MATKUL']),
                'FNO_KTP'=> $this->state['FNO_KTP'],
                'FNIM'=> $this->state['FNIM'],
                'FN_MAHASISWA'=> $this->state['FN_MAHASISWA'],
                'FK_KEL'=> $this->state['FK_KEL'],
                'FTMP_LAHIR'=> $this->state['FTMP_LAHIR'],
                'FTGL_LAHIR'=> $this->state['FTGL_LAHIR'],
                'FSTATUS_AKTIF'=> $this->state['FSTATUS_AKTIF'],
                'FASAL_SEKOLAH'=> $this->state['FASAL_SEKOLAH'],
                'FNO_TELP_HP'=> $this->state['FNO_TELP_HP'],
                'FN_AYAH'=> $this->state['FN_AYAH'],
                'FN_IBU'=> $this->state['FN_IBU'],
                'FALAMAT'=> $this->state['FALAMAT'],
                'FNO_TELP_AYAH'=> $this->state['FNO_TELP_AYAH'],
                'FK_AGAMA'=> $this->state['FK_AGAMA'],
                'FTHN_AJARAN'=> $this->state['FTHN_AJARAN'],
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
            $getData = Mahasiswa::where('FNIM', '=', $id)->firstOrFail();

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
