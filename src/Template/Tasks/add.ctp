<!-- File: src/Template/Tasks/add.ctp -->

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
		<td>
			<br>
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
	<?= $this->Form->button(__('SALVAR'), array( 'style' => 'background-color: #F7C325 !important; width: 430px !important;' )); ?>
	<?= $this->Form->end() ?>
</div>