<?php
// src/Controller/TasksController.php

namespace App\Controller;

class TasksController extends AppController
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Flash'); // Inclui o FlashComponent
    }
	
	public function isAuthorized($user)
	{
		// Todos os usuários registrados podem adicionar tarefas
		if ($this->request->getParam('action') === 'add') 
		{
			return true;
		}

		// Apenas o proprietário da tarefa pode editar e excluir
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

    public function index()
    {
		$user = $this->Auth->user();
		
		if($user)
		{
			$this->set('user', $user);	
			
			$this->set('tasks', $this->Tasks->find('all', 
													['conditions' => ['Tasks.fkuser' => $user['id']] , 'order' => ['Tasks.done' => 'ASC']]
													));
		}
		else
		{
			return $this->redirect(['controller'=> 'users', 'action' => 'login']);			
		}
    }

    public function view($id)
    {
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
                $this->Flash->success(__('Sua tarefa foi salva.'));
				
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não é possível adicionar a sua tarefa.'));
        }
        $this->set('task', $task);
    }	
	
	public function edit($id = null)
	{
		$task = $this->Tasks->get($id);
		
		if ($this->request->is(['post', 'put'])) 
		{
			$this->Tasks->patchEntity($task, $this->request->getData());
			
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
				$this->Flash->success(__('Sua tarefa foi atualizada'));
				
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Sua tarefa não pôde ser atualizada'));
		}

		$this->set('task', $task);
	}	
	
	public function changeStatus($id)
    {
		$task = $this->Tasks->get($id);
 
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
			return $this->redirect(['action' => 'index']);
		}
		
		$this->Flash->error(__('Sua tarefa não pôde ser atualizada.'));
    }	
	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$task = $this->Tasks->get($id);
		
		if ($this->Tasks->delete($task)) 
		{
			$this->Flash->success(__('A tarefa com id: {0} foi deletada.', h($id)));
			
			return $this->redirect(['action' => 'index']);
		}
	}	
}
?>