<?php
// src/Controller/TasksController.php

namespace App\Controller;

class TasksController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Incluir o FlashComponent
    }
	
    public function index()
    {
		//Obter o usuário autenticado
		$user = $this->Auth->user();
		
		//Verificar se existe usuário autenticado, senão redireciona para página de login
		if($user)
		{
			//Definir o usuário autenticado
			$this->set('user', $user);	
			
			//Definir a lista de tarefas do usuário que está logado, ordenadas pelo status de concluído
			$this->set('tasks', $this->Tasks->find('all', 
													['conditions' => ['Tasks.fkuser' => $user['id']] , 'order' => ['Tasks.done' => 'ASC']]
													));
		}
		else
		{
			//Redirecionar para a página de login
			return $this->redirect(['controller'=> 'users', 'action' => 'login']);			
		}
    }	
	
	public function isAuthorized($user)
	{
		//Todos os usuários registrados podem adicionar tarefas
		if ($this->request->getParam('action') === 'add') 
		{
			return true;
		}

		//Apenas o proprietário da tarefa pode editar e excluir
		if (in_array($this->request->getParam('action'), ['edit', 'changeStatus', 'delete'])) 
		{
			$taskId = (int)$this->request->getParam('pass.0');
			
			if ($this->Tasks->isOwnedBy($taskId, $user['id'])) 
			{
				return true;
			}
		}

		return parent::isAuthorized($user);
	}	

    public function view($id)
    {
		//Obter a tarefa pelo identificador da tarefa
        $task = $this->Tasks->get($id);
        $this->set(compact('task'));
    }

    public function add()
    {
        $task = $this->Tasks->newEntity();
		
        if ($this->request->is('post')) 
		{
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
			
			$task->fkuser = $this->Auth->user('id');
			$task->datecreate = date("Y-m-d H:i:s");

			//Verificar se tarefa está concluída para definir data de conclusão, senão define como nula
			if($task->done)
			{
				$task->datedone = date("Y-m-d H:i:s");	
			}
			else
			{
				$task->datedone = null;			
			};
		
            if ($this->Tasks->save($task)) 
			{
				//Exibir mensagem de aviso de criação da nova tarefa
                $this->Flash->success(__('Sua tarefa foi salva.'));
				
				//Redirecionar para a página da lista de tarefas				
                return $this->redirect(['action' => 'index']);
            }
			
			//Exibir mensagem de aviso caso não seja possível criar a nova tarefa
            $this->Flash->error(__('Não é possível adicionar a sua tarefa.'));
        }
		
        $this->set('task', $task);
    }	
	
	public function edit($id = null)
	{
		//Obter tarefa pelo identificador
		$task = $this->Tasks->get($id);
		
		if ($this->request->is(['post', 'put'])) 
		{
			$this->Tasks->patchEntity($task, $this->request->getData());
			
			//Verificar se tarefa está concluída para definir data de conclusão, senão define como nula			
			if($task->done)
			{
				$task->datedone = date("Y-m-d H:i:s");	
			}
			else
			{
				$task->datedone = null;			
			};
			
			if ($this->Tasks->save($task))
			{
				//Exibir mensagem de aviso de ataulização dos dados tarefa				
				$this->Flash->success(__('Sua tarefa foi atualizada'));
				
				return $this->redirect(['action' => 'index']);
			}
			
			//Exibir mensagem de aviso caso não seja possível alterar a tarefa			
			$this->Flash->error(__('Sua tarefa não pôde ser atualizada'));
		}

		$this->set('task', $task);
	}	
	
	public function changeStatus($id)
    {
		//Obter tarefa pelo identificador		
		$task = $this->Tasks->get($id);
 
		//Verificar se tarefa está concluída
		//Caso esteja concluída, alterar para 'não concluído (false)' e definir data de conclusão como nula
		//Caso não esteja concluída, alterar para 'concluído (true)' e definir data de conclusão
        if($task->done)
		{
			$task->done = false;
			$task->datedone = null;		
		}
		else
		{
			$task->done = true;
			$task->datedone = date("Y-m-d H:i:s");			
        };
 
		if ($this->Tasks->save($task))
		{			
			//Recarregar a lista de tarefas caso consiga alterar o status da tarefa
			return $this->redirect(['action' => 'index']);
		}
		
		//Exibir mensagem de aviso caso não seja possível alterar o status da tarefa
		$this->Flash->error(__('Sua tarefa não pôde ser atualizada'));
    }	
	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		//Obter tarefa pelo identificador
		$task = $this->Tasks->get($id);
		
		if ($this->Tasks->delete($task)) 
		{
			//Exibir mensagem de aviso caso informando que a tarefa foi deletada
			$this->Flash->success(__('A tarefa com id: {0} foi deletada', h($id)));
			
			//Redirecionar para a lista de tarefas caso consiga deletar da tarefa			
			return $this->redirect(['action' => 'index']);
		}
		
		//Exibir mensagem de aviso caso não seja possível deletar a tarefa
		$this->Flash->error(__('Sua tarefa não pôde ser deletada'));		
	}	
}
?>