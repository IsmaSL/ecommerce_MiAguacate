<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Image;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{
    public $product, $categories, $slug;
    public $category_id;
    protected $rules = [
        'product.category_id' => 'required',
        'product.seller' => 'required',
        'product.name' => 'required',
        'slug' => 'required|unique:products,slug',
        'product.description' => 'required',
        'product.price' => 'required',
        'product.quantity' => 'required'
    ];
    protected $listeners = ['refreshProduct','delete'];

    public function mount(Product $product){
        $this->product = $product;
        $this->categories = Category::all();
        $this->category_id = $product->category->id;
        $this->slug = $this->product->slug;
    }

    public function refreshProduct(){
        $this->product = $this->product->fresh();
    }

    public function updatedProductName($value){
        $this->slug = Str::slug($value);
    }

    public function save(){
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:products,slug,' . $this->product->id;
        $this->validate($rules);

        $this->product->slug = $this->slug;

        $this->product->save();

        $this->emit('saved');
    }

    public function deleteImage(Image $image){
        Storage::delete([$image->url]);
        $image->delete();

        $this->product = $this->product->fresh();
    }

    public function delete(){
        $images = $this->product->images;
        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }
        // $this->refreshProduct();
        $this->product->delete();
        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}
