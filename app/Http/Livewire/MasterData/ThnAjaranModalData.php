<?php

namespace App\Http\Livewire\MasterData;

use App\Models\ThnAjaran;
use Livewire\Component;
use Livewire\WithPagination;

class ThnAjaranModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalThnAjaran'
    ];
    
    public function render()
    {
        $getData = new ThnAjaran();

        $getData = $getData->orderBy('FTHN_AJARAN', 'ASC')->paginate(5);
        return view('livewire.master-data.thn-ajaran-modal-data', [
            'dataThnAjaran' => $getData
        ]);
    }

    public function openModalThnAjaran($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-thn_ajaran', $showProps);
    }

    public function pilihThnAjaran($id)
    {
        try {
            $getData = ThnAjaran::where('FTHN_AJARAN', '=', $id)->firstOrFail();

            
            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedThnAjaran', $getData->toArray());
            }

            $this->emit('modal-thn_ajaran', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
}
