<?php

namespace App\Http\Controllers;
use App\Models\producto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class productoscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = producto::all();

        // Pasa los datos a la vista usando Inertia
        return Inertia::render('Product/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 

   

        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
        ]);
    
       // Crear el producto
       Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
       ]);
   
   

       return redirect()->route('producto.index')->with('success', 'Producto agregado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
