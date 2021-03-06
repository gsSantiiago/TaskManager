<?php
// src/Model/Table/UsersTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{	
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name', 'Nome é necessário')		
            ->notEmpty('username', 'Login é necessário')
            ->notEmpty('password', 'Senha é necessária');

        return $validator;
    }	
}
?>