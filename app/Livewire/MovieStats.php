<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Movie;

class MovieStats extends Component
{
    // We need to contact with multiple events
    #[On('movie-added')]
    #[On('movie-updated')]
    #[On('movie-deleted')]
    public function refreshStats() {}

    public function render()
    {
        return view('livewire.movie-stats',[
            'total' => Movie::count(),
            'finished' => Movie::where('status', 'Finished')->count(),
            'avgRating' => round(Movie::avg('rating'),1) ?:0,
        ]);
    }
}
