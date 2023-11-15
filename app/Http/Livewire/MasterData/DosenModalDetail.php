<?php

namespace App\Http\Livewire\MasterData;

use Livewire\Component;
use App\Models\Dosen;

class DosenModalDetail extends Component
{
    public $dosen = [];

    protected $listeners = [
        'openModalDetail'
    ];

    public function render()
    {
        return view('livewire.master-data.dosen-modal-detail');
    }

    public function openModalDetail($data)
    {
        try {
            $getData = Dosen::with([
                'agama',
                'jurusan'
            ])->where('FK_NIDN', '=', $data['FK_NIDN'])->firstOrFail();
            $this->dosen = $getData->toArray();
            
        } catch (\Exception $e) {
            dd($e);
        }

        $showProps = $data['showProps'] ?? 'show';
        
        $this->emit('open-modal-detail', $showProps);
        
    }
}
