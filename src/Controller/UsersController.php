<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{	
    public function beforeFilter(Event $event)
    {
		parent::beforeFilter($event);
		
		//Permitir aos usuários se registrarem e efetuar logout
		$this->Auth->allow(['add', 'logout']);
    }
	
	public function login()
	{
		if ($this->request->is('post')) 
		{
			//Obter o usuário autenticado
			$user = $this->Auth->identify();
			
			//Verificar se existe usuário autenticado
			if ($user) 
			{
				//Definir o usuário autenticado				
				$this->Auth->setUser($user);
				
				return $this->redirect($this->Auth->redirectUrl());
			}
			
			//Exibir mensagem de aviso que usuário e/ou senha são inválidos 
			//Caso não encontre nenhum usuário autenticado
			$this->Flash->error(__('Usuário e/ou senha inválido, tente novamente'));
		}
	}

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}	

	public function index()
	{
		//Definir a lista de usuários do sistema		
        $this->set('users', $this->Users->find('all'));		
    }

    public function add()
    {
        $user = $this->Users->newEntity();
		
        if ($this->request->is('post')) 
		{
            $user = $this->Users->patchEntity($user, $this->request->getData());
			
            if ($this->Users->save($user)) 
			{
				//Exibir mensagem de aviso de criação do novo usuário				
                $this->Flash->success(__('O usuário foi salvo'));
				
				//Redirecionar para a página de login
                return $this->redirect(['action' => 'login']);
            }
			
			//Exibir mensagem de aviso caso não seja possível criar um novo usuário		
            $this->Flash->error(__('Não é possível adicionar o usuário'));
        }
		
        $this->set('user', $user);
    }	
}
?>