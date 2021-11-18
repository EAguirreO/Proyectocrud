<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $response = Product::get();
            return $response;
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $product=new Product();
            $product->nombre = $request->input('nombre');
            $product->descripcion = $request->input('descripcion');
            $product->estado = $request->input('estado');
            $product->subcategoria = $request->input('subcategoria');

            $nombreImagen = date('Ymdhis') . '.' . $request->file('imagenProducto')->extension();
            $ruta = storage_path().'\app\public\imagenes/' . $nombreImagen;
            $product->imagen = 'storage/imagenes/' . $nombreImagen;

            $img = Image::make($request->file('imagenProducto'));
            $width = $img->width();
            
            if($width>500 || $width<100){
                $img->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta);
            } else{
                $img->save($ruta);
            }

            $product->save();

            return response()->json([
                'successMsg'=>'Se registró el producto.',
            ]);

        } catch(Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'successMsg' => 'Error al registrar el producto, Vuelva a intentarlo.',
                'exito' => 0
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $response = Product::find($id);
            return $response;
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $producto = Product::find($id);
        if($producto!=null){

            $nombre = $request->input('nombre');
            $descripcion = $request->input('descripcion');
            $estado = $request->input('estado');
            $subcategoria = $request->input('subcategoria');

            if($request->hasFile('imagenProducto')){

                $url = str_replace('storage', 'public', $producto->imagen);
                Storage::delete($url);
                $nombreImagen = date('Ymdhis') . '.' . $request->file('imagenProducto')->extension();
                $ruta = storage_path().'\app\public\imagenes/' . $nombreImagen;
                $imagen = 'storage/imagenes/' . $nombreImagen;
                $img = Image::make($request->file('imagenProducto'));
                $width = $img->width();
                if($width>500 || $width<100){
                    $img->resize(500, null, function($constraint){$constraint->aspectRatio();})->save($ruta);
                } else{
                    $img->save($ruta);
                }
                Product::where('id', $id)->update([
                    'nombre'=>$nombre,
                    'descripcion'=>$descripcion,
                    'estado'=>$estado,
                    'subcategoria'=>$subcategoria,
                    'imagen'=>$imagen
                ]);

            } else {
                Product::where('id', $id)->update([
                    'nombre'=>$nombre,
                    'descripcion'=>$descripcion,
                    'estado'=>$estado,
                    'subcategoria'=>$subcategoria
                ]);
            }

            return json_encode(['message'=>'edited']);
        } else {
            return json_encode(['message'=>'El producto no existe']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Product::find($id);
        if($producto!=null){
            $url = str_replace('storage', 'public', $producto->imagen);
            Storage::delete($url);
            Product::destroy($id);
            return json_encode(['message'=>'removed']);
        } else {
            return json_encode(['message'=>'no existe']);
        }
    }
}
