<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class AllImages extends Component
{
    use WithPagination, WithoutUrlPagination;

    protected $listeners = ['loadMore'];

    protected $page = 1;

    public function loadMore()
    {
        $this->page++;
    }

    public function render()
    {
        $images = Image::paginate(10 * $this->page);
        return view('livewire.all-images', ['images' => $images]);
    }
}