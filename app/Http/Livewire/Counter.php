<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Grade;

class Counter extends Component
{

    public $search = '';

    protected $rules = [
        'search' => 'required|email',
    ];

    public function render()
    {
        return view('livewire.counter', [
            'users' => Grade::where('notes', 'like', '%'.$this->search.'%')->get(),
        ]);
    }


}
