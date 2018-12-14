<!-- File: src/Template/Users/add.ctp -->

<div class="users form">
	<?= $this->Form->create($user) ?>
	<table style="border-spacing: 0px; padding-bottom: 90px;">
		<tr>
			<td colspan="2">
				<div>
					<?= $this->Form->input('name', array( 'label' => false, 'placeholder' => 'Nome' )) ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div>
					<?= $this->Form->input('username', array( 'label' => false, 'placeholder' => 'Usuário' )) ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div>
					<?= $this->Form->input('password', array( 'label' => false, 'placeholder' => 'Senha' )) ?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<br>
			</td>
		</tr>
	</table>
	<div class="divActions">
		<?php
		echo $this->Html->link('<input class="btBack"/>',
		array(
			  'action'   => 'login'
			  ),
		array(
			  'escape'   => false
			 ));
		 ?>
		<?= $this->Form->button(__('SALVAR'), array( 'style' => 'background-color: #F7C325 !important; width: 430px !important;' )); ?>
		<?= $this->Form->end() ?>	
	</div>
</div>
