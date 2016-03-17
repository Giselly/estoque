<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace estoque\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * Description of ProdutosController
 *
 * @author MC88
 */
class ProdutoController extends Controller{
    
    public function lista()
    {   
        $produtos = DB::select('select * from produtos');    
        return view('produto.listagem')->with('produtos', $produtos);
    }
    
    public function mostra()
    {
        $id = Request::route('id');; 
        $resposta =
        DB::select('select * from produtos where id = ?',[$id]);
        if(empty($resposta))
        {
           return "Esse produto não existe";
        } else
        {
           return view('produto.detalhes')->with('p', $resposta[0]);
        }      
    }
    
    public function novo()
    {
        return view('produto.formulario');
    }
    
    public function adiciona(){
        // pegar dados do formulario
        $nome = Request::input('nome');
        $descricao = Request::input('descricao');
        $valor = Request::input('valor');
        $quantidade = Request::input('quantidade');
        /** Outra Alternativa
            Podemos sim utilizar o método all da Request para pegar todos
            os valores de uma única vez em um array, ou ainda o método only
            deixando explícito quais parâmetros queremos buscar:
            $all = Request::all();
            $only = Request::only('nome', 'valor', '...');  
         */
        
        // salvar no banco de dados
        // retornar alguma view
        DB::insert('insert into produtos values (null, ?, ?, ?, ?)',
        array($nome, $valor, $descricao, $quantidade));
        //$produtos = DB::select('select * from produtos');
        //return view('produto.listagem')->with('produtos', $produtos);
        return view('produto.adicionado');
        
    }
}
