<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Productos extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $showModal = 'hidden';
    public $product;
    public $auxsubcategoria;
    public $open_edit = false;
    public $open_imagen = false;
    public $imagenProducto;

    public $nombre, $descripcion, $stock, $precio, $imageProduct, $imageProduct_1, $imageProduct_2, $imageProduct_3, $imageProduct_4, $identificador, $identificador_1, $identificador_2, $identificador_3, $identificador_4;
    public $subcat, $subcategorias;

    protected $listeners = ['render' => 'render', 'delete'];

    public function mount(){
        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();
        $this->product = new Product();
        $this->imagenProducto = new Product();
        $this->auxsubcategoria = new Subcategory();
        $this->subcategorias = Subcategory::all();
    }

    public $rules = [
        'product.nombre' => 'required',
        'product.descripcion' => 'required',
        'product.estado' => 'required',
        'product.stock' => 'required|integer',
        'product.precio' => 'required',
        'imageProduct' => 'required|image',
        'imageProduct_1' => 'image|nullable',
        'imageProduct_2' => 'image|nullable',
        'imageProduct_3' => 'image|nullable',
        'imageProduct_4' => 'image|nullable',
    ];

    public function render()
    {
        $productos = Product::paginate(10);
        return view('livewire.productos',[
            'productos'=>$productos,
        ]);
    }

    public function verifyColor($variable){
        if($variable == 'Activo'){
            return 'green';
        } else{
            return 'red';
        }

    }

    public function edit(Product $product){
        $this->product = $product;
        $this->subcat = $product->subcategoria;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();

        if($this->imageProduct){
            $url = str_replace('storage', 'public', $this->product->imagen);
            Storage::delete($url);
            $nombreImagen = date('Ymdhis') . '.' . $this->imageProduct->extension();
            $ruta = storage_path().'\app\public\imagenes/' . $nombreImagen;
            $this->product->imagen = 'storage/imagenes/' . $nombreImagen;
            $img = Image::make($this->imageProduct);
            $width = $img->width();
            if($width>500 || $width<100){
                $img->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta);
            } else{
                $img->save($ruta);
            }
        }

        if($this->imageProduct_1){
            if(!is_null($this->product->imagen1)){
                $url = str_replace('storage', 'public', $this->product->imagen1);
                Storage::delete($url);
            }
            $nombreImagen_1 = date('Ymdhis') + 1 . '.' . $this->imageProduct_1->extension();
            $ruta_1 = storage_path().'\app\public\imagenes/' . $nombreImagen_1;
            $this->product->imagen1 = 'storage/imagenes/' . $nombreImagen_1;
            $img_1 = Image::make($this->imageProduct_1);
            $width = $img_1->width();
            if($width>500 || $width<100){
                $img_1->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_1);
            } else{
                $img_1->save($ruta_1);
            }
        }

        if($this->imageProduct_2){
            if(!is_null($this->product->imagen2)){
                $url = str_replace('storage', 'public', $this->product->imagen2);
                Storage::delete($url);
            }
            $nombreImagen_2 = date('Ymdhis') + 2 . '.' . $this->imageProduct_2->extension();
            $ruta_2 = storage_path().'\app\public\imagenes/' . $nombreImagen_2;
            $this->product->imagen2 = 'storage/imagenes/' . $nombreImagen_2;
            $img_2 = Image::make($this->imageProduct_2);
            $width = $img_2->width();
            if($width>500 || $width<100){
                $img_2->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_2);
            } else{
                $img_2->save($ruta_2);
            }
        }

        if($this->imageProduct_3){
            if(!is_null($this->product->imagen3)){
                $url = str_replace('storage', 'public', $this->product->imagen3);
                Storage::delete($url);
            }
            $nombreImagen_3 = date('Ymdhis') + 3 . '.' . $this->imageProduct_3->extension();
            $ruta_3 = storage_path().'\app\public\imagenes/' . $nombreImagen_3;
            $this->product->imagen3 = 'storage/imagenes/' . $nombreImagen_3;
            $img_3 = Image::make($this->imageProduct_3);
            $width = $img_3->width();
            if($width>500 || $width<100){
                $img_3->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_3);
            } else{
                $img_3->save($ruta_3);
            }
        }

        if($this->imageProduct_4){
            if(!is_null($this->product->imagen4)){
                $url = str_replace('storage', 'public', $this->product->imagen4);
                Storage::delete($url);
            }
            $nombreImagen_4 = date('Ymdhis') + 4 . '.' . $this->imageProduct_4->extension();
            $ruta_4 = storage_path().'\app\public\imagenes/' . $nombreImagen_4;
            $this->product->imagen4 = 'storage/imagenes/' . $nombreImagen_4;
            $img_4 = Image::make($this->imageProduct_4);
            $width = $img_4->width();
            if($width>500 || $width<100){
                $img_4->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_4);
            } else{
                $img_4->save($ruta_4);
            }
        }


        $this->product->subcategoria = $this->subcat;
        $this->product->save();

        $this->reset(['open_edit', 'imageProduct', 'imageProduct_1', 'imageProduct_2', 'imageProduct_3', 'imageProduct_4']);

        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();

        $this->emit('alert', 'Producto actualizado correctamente');
    }

    public function resetModal(){
        $this->reset(['open_edit', 'imageProduct', 'imageProduct_1', 'imageProduct_2', 'imageProduct_3', 'imageProduct_4']);
        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();
    }

    public function delete(Product $product){
        $url = str_replace('storage', 'public', $product->imagen);
        Storage::delete($url);
        $url_1 = str_replace('storage', 'public', $product->imagen1);
        Storage::delete($url_1);
        $url_2 = str_replace('storage', 'public', $product->imagen2);
        Storage::delete($url_2);
        $url_3 = str_replace('storage', 'public', $product->imagen3);
        Storage::delete($url_3);
        $url_4 = str_replace('storage', 'public', $product->imagen4);
        Storage::delete($url_4);
        $product->delete();
    }

    public function verImagen(Product $product){
        $this->imagenProducto = $product;
        $this->open_imagen = true;
    }
}
