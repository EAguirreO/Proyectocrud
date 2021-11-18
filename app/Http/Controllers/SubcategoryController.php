<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Exception;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $response = Subcategory::get();
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
            $subcategory=new Subcategory();

            $subcategory->nombre = $request->input('nombre');
            $subcategory->orden = $request->input('orden');
            $subcategory->estado = $request->input('estado');
            $subcategory->categoria = $request->input('categoria');
            $subcategory->save();

            return response()->json([
                'successMsg'=>'Se registró la subcategoria'
            ]);

        } catch (Exception $ex) {
            return response()->json([
                'message'=> $ex->getMessage(),
                'error'=>'Error al registrar la subcategoria, vuelva a intentarlo.'
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
            $response = Subcategory::find($id);
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
    public function edit(Request $request,$id)
    {
        $subcategoria = Subcategory::find($id);
        if($subcategoria!=null){
            $nombre = $request->input('nombre');
            $orden = $request->input('orden');
            $estado = $request->input('estado');
            $categoria = $request->input('categoria');
            Subcategory::where('id', $id)->update([
                'nombre'=>$nombre,
                'orden'=>$orden,
                'estado'=>$estado,
                'categoria'=>$categoria
            ]);
            return json_encode(['message'=>'edited']);
        } else{
            return json_encode(['message'=>'subcategoria no existe']);
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
        $subcategoria = Subcategory::find($id);
        if($subcategoria!=null){
            Subcategory::destroy($id);
            return json_encode(['message'=>'removed']);
        } else {
            return json_encode(['message'=>'subcategoria no existe']);
        }
    }
}
