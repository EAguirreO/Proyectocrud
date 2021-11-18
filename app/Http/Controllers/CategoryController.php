<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $response = Category::get();
            return $response;
        }catch(Exception $ex){
            return response()->json(['message'=> $ex->getMessage()], 500);
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
        try {
            $category=new Category();

            $category->nombre = $request->input('nombre');
            $category->orden = $request->input('orden');
            $category->estado = $request->input('estado');
            $category->save();

            return response()->json([
                'successMsg'=>'Se registró la categoría'
            ]);

        } catch (Exception $ex) {
            return response()->json([
                'message'=> $ex->getMessage(),
                'error'=>'Error al registrar la categoria, vuelva a intentarlo.'
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
            $response = Category::find($id);
            return $response;
        }catch(Exception $ex){
            return response()->json(['message'=>$ex->getMessage()], 500);
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
        $categoria = Category::find($id);
        if($categoria!=null){
            $nombre = $request->input('nombre');
            $orden = $request->input('orden');
            $estado = $request->input('estado');
            Category::where('id', $id)->update([
                'nombre'=>$nombre,
                'orden'=>$orden,
                'estado'=>$estado
            ]);
            return json_encode(['message'=>'edited']);
        } else{
            return json_encode(['message'=>'categoria no existe']);
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
        $categoria = Category::find($id);
        if($categoria!=null){
            Category::destroy($id);
            return json_encode(['message'=>'removed']);
        } else {
            return json_encode(['message'=>'categoria no existe']);
        }
    }
}
