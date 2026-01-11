<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class MovieList extends Component
{
    use WithPagination;

    // Search and Pagination
    #[Url]
    public $search = '';

    // Inline Editing State
    public $editingMovieId = null;
    public $editingTitle = '';

    /**
     * Listener: Refreshes the list when a new movie is added
     */
    #[On('movie-added')]
    public function refreshList()
    {
        // Livewire auto-refreshes when an event is heard
    }

    /**
     * Reset pagination to page 1 whenever the user types in search
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Start the editing mode for a specific movie
     */
    public function editMovie($id, $currentTitle)
    {
        $this->editingMovieId = $id;
        $this->editingTitle = $currentTitle;
    }

    /**
     * Save the edited title to the database
     */
    public function saveEdit()
    {
            if (!$this->editingMovieId) {
            return;
        }

        $movie = Movie::find($this->editingMovieId);

        // Only update if the movie was actually found
        if ($movie) {
            $movie->update([
                'title' => $this->editingTitle
            ]);
            $this->dispatch('movie-updated');
        }

        $this->cancelEdit();
    }

    /**
     * Exit edit mode without saving
     */
    public function cancelEdit()
    {
        $this->editingMovieId = null;
        $this->editingTitle = '';
    }

    /**
     * Toggle between 'Finished' and 'To watch'
     */
    public function toggleStatus(Movie $movie)
    {
        $movie->update([
            'status' => $movie->status === 'Finished' ? 'To watch' : 'Finished'
        ]);

        $this->dispatch('movie-updated');
    }

    /**
     * Set the 1-5 star rating
     */
    public function setRating(Movie $movie, $rating)
    {
        $movie->update(['rating' => $rating]);
        $this->dispatch('movie-updated');
    }

    /**
     * Remove movie from database
     */
    public function deleteMovie(Movie $movie)
    {
        $movie->delete();
        $this->dispatch('movie-deleted');
    }

    public function render()
    {
        $movies = Movie::where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(15);

        return view('livewire.movie-list', [
            'movies' => $movies
        ]);
    }
}