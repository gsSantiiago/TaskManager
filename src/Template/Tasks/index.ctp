<!-- File: src/Template/Tasks/index.ctp -->

<br>
<div style="color:#F7C325">Tarefas de <?= $user['name'] ?></div>	
<br>
<table>
    <?php 
	if ($tasks->count()) 
	{
		foreach ($tasks as $task): 
	?>
		<tr>
			<?php
				if($task->done)
				{
			?>
			<td rowspan="2" class="status status-concluido">
				<div>
				<?php     echo $this->Form->postLink('<div></div>',
                array(
                      'action'   => 'changeStatus', $task->id
                      ),
                array(
                      'escape'   => false
                     ));
				 ?>							
				</div>
			</td>
			<?php
			}
			else
			{
			?>
			<td rowspan="2" class="status status-pendente">
				<div>
				<?php     echo $this->Form->postLink('<div></div>',
                array(
                      'action'   => 'changeStatus', $task->id
                      ),
                array(
                      'escape'   => false
                     ));
				 ?>							
				</div>
			</td>
			<?php
			}
			?>
		</tr>  					
		<tr>
			<td class="tasks">
				<div>
					<?= $this->Html->link($task->title, ['action' => 'edit', $task->id]) ?>				
				</div>
			</td>
		</tr>
	<?php 
		endforeach;
	}
	else
	{
	?>
		<div style="color:#ffffff">Nenhuma tarefa cadastrada</div>
	<?php
	}	
	?>	
</table>					
<div class="menu">
	<table class="menuTable">
		<tr>
			<td>
				<div class="home">
					<a href="/Users/logout">
						<div class="home"></div>
					</a>
				</div>
			</td>
			<td>
				<div class="add">
					<a href="/Tasks/Add">
						<div class="add"></div>
					</a>
				</div>
			</td>
		</tr>
	</table>
</div>