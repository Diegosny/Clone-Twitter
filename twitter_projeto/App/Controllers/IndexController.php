<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{

	public function index()
    {

		$this->render('index');
	}

	public function inscreverse()
    {
		$this->render('inscreverse');
	}

    public function registrar()
    {
        $usuario = Container::getModel('Usuario');


        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha']
        ];


        if(
            empty($dados['nome']) ||
            empty($dados['email']) ||
            empty($dados['senha'])
        ) {
            echo 'não se pode ter campos vazios';
            return false;
        }

         $usuario->setCampos($dados);
         $usuario->salvaDados();
    }
}


