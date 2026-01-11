<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Movie;

class CreateMovie extends Component
{
    public $title = '';
    public $status = 'To watch';

    public function save()
    {
        // Walidacja
        $this->validate([
            'title'=>'required|min:3',
        ]);
        
        // Zapis do bazy
        Movie::create([
            'title' => $this->title,
            'status'=>$this->status,
        ]);

        // Reset formularza
        $this->reset('title');

        // For refreshList
        $this->dispatch('movie-added');

        // Powiadomienie tymczasowe
        session()->flash('message', 'Film dodany!');
    }

    // To było
    public function render()
    {
        return view('livewire.create-movie');
    }
}
