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
        $this->view->errorCadastro = false;
        $this->view->existeRegistro = false;
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


        $valida = $usuario->validaFormulario($dados);
        if(! $valida) {
            $this->view->errorCadastro = true;
            $this->render('inscreverse');
            return false;
        }

        $validaEmail = $usuario->verificaEmail($dados['email']);
        if($validaEmail) {
            $this->view->existeRegistro = true;
            $this->render('inscreverse');
            return false;
        }

        $usuario->setCampos($dados);
        $usuario->salvaDados();
        
        return $this->render('cadastro');
    }
}


