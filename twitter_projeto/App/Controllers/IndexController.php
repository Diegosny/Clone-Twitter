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

         $usuario->setCampos([
            'nome' => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => md5($_POST['senha'])
        ]);

         $usuario->salvaDados();
    }
}


