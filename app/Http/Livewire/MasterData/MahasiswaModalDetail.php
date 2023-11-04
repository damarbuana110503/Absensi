<?php

namespace App\Http\Livewire\MasterData;

use App\Models\Mahasiswa;
use Livewire\Component;

class MahasiswaModalDetail extends Component
{
    public $mahasiswa = [];
    
    protected $listeners = [
        'openModalDetail',
    ];

    public function render()
    {
        return view('livewire.master-data.mahasiswa-modal-detail');
    }

    public function openModalDetail($data)
    {
        try {
            $getData = Mahasiswa::with([
                'agama'
            ])->where('FNIM', '=', $data['FNIM'])->firstOrFail();
            $this->mahasiswa = $getData->toArray();
            
        } catch (\Exception $e) {
            dd($e);
        }

        $showProps = $data['showProps'] ?? 'show';
        
        $this->emit('open-modal-detail', $showProps);
        
    }
}
