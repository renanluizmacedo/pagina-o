<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteControlador extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    /* 
     public function index()
    {
        //$clientes = Cliente::all();
        $clientes = Cliente::paginate(10);
        return view('index',compact('clientes'));
    }

    */
    public function indexjs()
    {
        return view('indexjs');
    }

    public function indexjson(){
        return Cliente::paginate(10);
    }

 
}
