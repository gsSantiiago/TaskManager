<!-- File: src/Template/Tasks/edit.ctp -->

<?= $this->Form->create($task) ?>
<table style="border-spacing: 0px; padding-bottom: 90px;">
	<tr>
		<td colspan="3">
			<div>
				<?= $this->Form->input('title', array( 'label' => false, 'placeholder' => 'Título' )) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<div>
				<?= $this->Form->input('description', array( 'label' => false, 'placeholder' => 'Descrição' )) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<div style="width: 25px; color: #ffffff">
				Concluído? <?= $this->Form->checkbox('done', array( 'label' => false )) ?>
			</div>
		</td>
	</tr>	
	<tr>
		<td>
			<br>
			<br>
			<div style="color: #ffffff">
				<?php
				$datecreate = date("d-m-Y H:i:s", strtotime($task->datecreate));				
				?>
				Criado em <?= $datecreate ?>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<?php
			if($task->done)
			{
				$datedone = date("d-m-Y H:i:s", strtotime($task->datedone));			
			?>
				<div style="color: #ffffff">			
					Concluído em <?= $datedone ?>
				</div>
			<?php
			}
			?>
		</td>
	</tr>
	<tr>
		<td>
			<br>
		</td>
	</tr>
</table>
<div class="divActions">
	<input type="" onclick="location.href = '/tasks'" class="btBack">
	<?= $this->Form->button(__('SALVAR'), array( 'class' => 'btSave', 'name' => 'edit' )); ?>
	<?= $this->Form->end() ?>	
	<?= $this->Form->postLink(
		'EXCLUIR',
		['action' => 'delete', $task->id],	
		['class' => 'btDelete', 'confirm' => 'Tem certeza que deseja excluir esta tarefa?'])
	?>	
</div>