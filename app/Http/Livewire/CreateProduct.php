<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CreateProduct extends Component
{

    use WithFileUploads;

    public $open = false;
    public $nombre, $descripcion, $stock, $precio, $imageProduct, $identificador;
    public $imageProduct_1, $imageProduct_2, $imageProduct_3, $imageProduct_4;
    public $identificador_1, $identificador_2, $identificador_3, $identificador_4;
    public $subcat, $subcategorias;

    protected $rules = [
        'nombre' => 'required',
        'descripcion' => 'required',
        'stock' => 'required|integer',
        'precio' => 'required',
        'imageProduct' => 'required|image',
        'imageProduct_1' => 'image|nullable',
        'imageProduct_2' => 'image|nullable',
        'imageProduct_3' => 'image|nullable',
        'imageProduct_4' => 'image|nullable',
        'subcat'=>'required',
    ];

    public function mount() {
        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();
        $this->subcategorias = Subcategory::all();
    }

    public function save(){
        
        $this->validate();

        $product=new Product();
        $product->nombre = $this->nombre;
        $product->descripcion = $this->descripcion;
        $product->stock = $this->stock;
        $product->precio = $this->precio;
        $product->estado = 'Activo';
        $product->subcategoria = $this->subcat;

        $nombreImagen = date('Ymdhis') . '.' . $this->imageProduct->extension(); //
        $ruta = storage_path().'\app\public\imagenes/' . $nombreImagen;
        $product->imagen = 'storage/imagenes/' . $nombreImagen;

        $img = Image::make($this->imageProduct);
        $width = $img->width();
        
        if($width>500 || $width<100){
            $img->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta);
        } else{
            $img->save($ruta);
        }

        if(!is_null($this->imageProduct_1)){
            $nombreImagen_1 = date('Ymdhis') + 1 . '.' . $this->imageProduct_1->extension(); //
            $ruta_1 = storage_path().'\app\public\imagenes/' . $nombreImagen_1;
            $product->imagen1 = 'storage/imagenes/' . $nombreImagen_1;

            $img_1 = Image::make($this->imageProduct_1);
            $width = $img_1->width();
            
            if($width>500 || $width<100){
                $img_1->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_1);
            } else{
                $img_1->save($ruta_1);
            }
        }

        if(!is_null($this->imageProduct_2)){
            $nombreImagen_2 = date('Ymdhis') + 2 . '.' . $this->imageProduct_2->extension(); //
            $ruta_2 = storage_path().'\app\public\imagenes/' . $nombreImagen_2;
            $product->imagen2 = 'storage/imagenes/' . $nombreImagen_2;

            $img_2 = Image::make($this->imageProduct_2);
            $width = $img_2->width();
            
            if($width>500 || $width<100){
                $img_2->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_2);
            } else{
                $img_2->save($ruta_2);
            }
        }

        if(!is_null($this->imageProduct_3)){
            $nombreImagen_3 = date('Ymdhis') + 3 . '.' . $this->imageProduct_3->extension(); //
            $ruta_3 = storage_path().'\app\public\imagenes/' . $nombreImagen_3;
            $product->imagen3 = 'storage/imagenes/' . $nombreImagen_3;

            $img_3 = Image::make($this->imageProduct_3);
            $width = $img_3->width();
            
            if($width>500 || $width<100){
                $img_3->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_3);
            } else{
                $img_3->save($ruta_3);
            }
        }

        if(!is_null($this->imageProduct_4)){
            $nombreImagen_4 = date('Ymdhis') + 4 . '.' . $this->imageProduct_4->extension(); //
            $ruta_4 = storage_path().'\app\public\imagenes/' . $nombreImagen_4;
            $product->imagen4 = 'storage/imagenes/' . $nombreImagen_4;

            $img_4 = Image::make($this->imageProduct_4);
            $width = $img_4->width();
            
            if($width>500 || $width<100){
                $img_4->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta_4);
            } else{
                $img_4->save($ruta_4);
            }
        }

        $product->save();

        $this->reset([
        'open',
        'nombre',
        'descripcion',
        'precio',
        'stock', 
        'subcat', 
        'imageProduct',
        'imageProduct_1',
        'imageProduct_2',
        'imageProduct_3',
        'imageProduct_4'    
        ]);

        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();

        $this->emitTo('productos','render');
        $this->emit('alert', 'Producto creado exitosamente');
        
    }

    public function render()
    {
        return view('livewire.create-product');
    }

    public function resetModal(){
        $this->reset([
            'open',
            'nombre',
            'descripcion',
            'precio',
            'stock', 
            'subcat', 
            'imageProduct',
            'imageProduct_1',
            'imageProduct_2',
            'imageProduct_3',
            'imageProduct_4'    
        ]);
        
        $this->identificador = rand();
        $this->identificador_1 = rand();
        $this->identificador_2 = rand();
        $this->identificador_3 = rand();
        $this->identificador_4 = rand();
    }
}
