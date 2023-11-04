<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Matkul;
use Livewire\Component;
use Livewire\WithPagination;

class MatkulModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalMatkul'
    ];
    
    public function render()
    {
        $getData = new Matkul();

        $getData = $getData->orderBy('FK_MATKUL', 'ASC')->paginate(5);
        return view('livewire.master-data.matkul-modal-data', [
            'dataMatkul' => $getData
        ]);
    }

    public function openModalMatkul($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-matkul', $showProps);
    }

    public function pilihMatkul($id)
    {
        try {
            $getData = Matkul::where('FK_MATKUL', '=', $id)->firstOrFail();

            
            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedMatkul', $getData->toArray());
            }

            $this->emit('modal-matkul', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
}
