<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class Galleries extends Component
{

    public $product_id;
    protected $listeners = [
        'destroyGallery',
        'refreshComponent' => '$refresh'
    ];
    public function deleteGalleryt($product_id, $id)
    {
        $this->dispatch('deleteGallery', product_id: $product_id, id: $id);
    }
    public function destroyGallery($product_id, $id)
    {
        $gallery = Gallery::query()->where('product_id', $product_id)->where('id', $id)->first();
        // dd($product_id, $id, $gallery);
        $path = public_path('images/admin/products/big/' . $gallery->image);
        if (file_exists($path)) {
            unlink($path);
        }
        $gallery->delete();
        $this->dispatch('refreshComponent');
    }
    public function render()
    {
        $galleries  = Gallery::query()->get();
        return view('livewire.admin.galleries', compact('galleries'));
    }
}
