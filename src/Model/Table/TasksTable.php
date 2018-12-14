<?php
// src/Model/Table/TasksTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TasksTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title');

        return $validator;
    }	
	
	public function isOwnedBy($taskId, $userId)
	{
		return $this->exists(['id' => $taskId, 'fkuser' => $userId]);
	}	
}
?>