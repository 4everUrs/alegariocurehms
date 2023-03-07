<?php

namespace App\Http\Livewire\Collection;

use App\Models\NewestCollection;
use Livewire\Component;

class CollectionView extends Component
{
    public function render()
    {
        return view('livewire.collection.collection-view', [
            'collections' => NewestCollection::where('category', '!=', 'Notes Recievables')->get()
        ]);
    }
}
