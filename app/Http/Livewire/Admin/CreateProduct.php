<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    public $categories;
    public $category_id = "";
    public $seller, $name, $slug, $description, $price, $quantity;

    protected $rules = [
        'category_id' => 'required',
        'seller' => 'required',
        'name' => 'required',
        'slug' => 'required|unique:products',
        'description' => 'required',
        'price' => 'required',
        'quantity' => 'required'
    ];

    public function mount(){
        $this->categories = Category::all();
    }

    public function updatedName($value){
        $this->slug = Str::slug($value);
    }

    public function save(){
        $this->validate();

        $product = new Product();
        $product->seller = $this->seller;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->description = $this->description;
        $product->category_id = $this->category_id;
        $product->price = $this->price;
        $product->quantity = $this->quantity;

        $product->save();

        return redirect()->route('admin.products.edit', $product);
    }

    public function render()
    {
        return view('livewire.admin.create-product')->layout('layouts.admin');
    }
}
