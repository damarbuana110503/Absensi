<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\WithPagination;

class DosenModalData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $source = null;

    protected $listeners = [
        'openModalDosen'
    ];
    
    public function render()
    {
        $getdata = new Dosen();

        $getdata = $getdata->orderBy('FK_NIDN', 'ASC')->paginate(5);
        return view('livewire.master-data.dosen-modal-data', [
            'dataDosen' => $getdata
        ]);
    }

    public function openModalDosen($data)
    {
        $this->reset('source');

        $this->source = $data['source'] ?? null;
        $showProps = $data['showProps'] ?? 'hide';

        $this->emit('modal-dosen', $showProps);
    }

    public function pilihDosen($id)
    {
        try {
            $getData = Dosen::where('FK_NIDN', '=', $id)->firstOrFail();

            
            if ($this->source != null) {
                $this->emitTo($this->source, 'selectedDosen', $getData->toArray());
            }

            $this->emit('modal-dosen', 'hide');
        } catch (\Exception $e) {
            $this->emit('error', 'Terjadi Kesalahan ! <br> Silahkan Hubungi Administrator !');
            dd($e);
        }
    }
}
