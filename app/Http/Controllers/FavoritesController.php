<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;

class FavoritesController extends Controller
{
    /**
     * index para mostrar todos los datos
     * store para guardar un dato
     * update para actualizar un dato
     * destroy para eliminar un dato
     * edit para mostrar el formulario de edicion
     * 
    */

    public function store(Request $request){

        $request -> validate([
            'name' => 'required',
        ]);

        $character = new Character;
        $character -> name = $request -> name;
        $character -> status = $request -> status;
        $character -> species = $request -> species;
        $character -> save();

        return redirect()->route('favorites')->with('success','Character saved success');
    }
    
    public function index(){
        $characters = Character::all();
        return view('favorites.index',['characters' => $characters]);
    }

    public function destroy($id){
       $character = Character::find($id);
       $character->delete();
       
       return redirect()->route('favorites')->with('success','Character deleted');
    }

}
