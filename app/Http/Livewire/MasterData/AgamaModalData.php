<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Agama;
use Livewire\Component;
use Livewire\WithPagination;

class AgamaModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalAgama'
    ];
    
    public function render()
    {
        $getData = new Agama();

        $getData = $getData->orderBy('FK_AGAMA', 'ASC')->paginate(5);
        return view('livewire.master-data.agama-modal-data', [
            'dataAgama' => $getData
        ]);
    }

    public function openModalAgama($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-agama', $showProps);
    }

    public function pilihAgama($id)
    {
        try {
            $getData = Agama::where('FK_AGAMA', '=', $id)->firstOrFail();

            
            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedAgama', $getData->toArray());
            }

            $this->emit('modal-Agama', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
    
}
