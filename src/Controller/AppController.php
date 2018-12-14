<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
	public function initialize()
	{
		$this->loadComponent('Flash');
		
		$this->loadComponent('Auth', [
			'authorize' => ['Controller'],		
			'loginRedirect' => [
				'controller' => 'Tasks',
				'action' => 'index'
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
				'home'
			]
		]);
	}
	
	public function isAuthorized($user)
	{
		// Bloqueia acesso por padrão
		return false;
	}
	
	public function beforeFilter(Event $event)
	{
        $this->Auth->allow(['index', 'view', 'display']);
	}
}
