<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Jurusan;
use Livewire\Component;
use Livewire\WithPagination;

class JurusanModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalJurusan'
    ];
    
    public function render()
    {
        $getData = new Jurusan();

        $getData = $getData->orderBy('FK_JURUSAN', 'ASC')->paginate(5);
        return view('livewire.master-data.jurusan-modal-data', [
            'dataJurusan' => $getData
        ]);
    }

    public function openModalJurusan($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-jurusan', $showProps);
    }

    public function pilihJurusan($id)
    {
        try {
            $getData = Jurusan::where('FK_JURUSAN', '=', $id)->firstOrFail();

            
            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedJurusan', $getData->toArray());
            }

            $this->emit('modal-jurusan', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
}
