<?php

namespace App\Http\Livewire\Client;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.client.home-page', [
            'Products' => Product::paginate(3)
        ]);
    }
}
