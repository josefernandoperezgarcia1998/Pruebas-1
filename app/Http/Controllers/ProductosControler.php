<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\Producto;
use App\Models\Categoria;

class ProductosControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->rol=="Supervisor") $productos = Producto::all();
        else $productos = Producto::where('usuario_id',Auth::id())->get();

        /*Aqui podemos hacer algunas cosas, como seleccionar que productos son los que cumplen cierta 
        condicion y los listaremos por ejemplo*/

        return view('Productos.index',compact('productos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('Productos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valores = $request->all();
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('prods/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino, $nombre_de_archivo);        
            $valores['imagen']=$nombre_de_archivo;
        }

        $valores['usuario_id']=Auth::id();

        $registro = new Producto();
        $registro->fill($valores);
        $registro->save();

        return redirect("/Productos")->with('mensaje','Producto agregado correctamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return view('Productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        return view('Productos.edit',compact('producto','categorias'));
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
        $valores = $request->all();
        $imagen = $request->file('imagen');
        if(!is_null($imagen)){
            $ruta_destino = public_path('fotos/');
            $nombre_de_archivo = $imagen->getClientOriginalName();
            $imagen->move($ruta_destino, $nombre_de_archivo);        
            $valores['imagen']=$nombre_de_archivo;
        }
        $valores['usuario_id']=Auth::id();
        $registro = Producto::find($id);
        if($registro->concesionado==0)$registro->concesionado=null;
        $registro->fill($valores);
        $registro->save();


        return redirect("/Productos")->with('mensaje','Producto modificado correctamente');

    }
   //    return;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //podemos hacer validaciones para borrar o no
        try {
            $registro = Producto::find($id);
            $registro->delete();
            return redirect("/Productos")->with('mensaje','Producto modificado correctamente');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect("/Productos")->with('error',$e->getMessage());
        }
       
    }
}
