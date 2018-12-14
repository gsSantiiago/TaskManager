<!-- File: src/Template/Users/login.ctp -->

<div class="users form" style="position: relative;top: 40px;">
	<div class="logo"></div>
	<div class="title">
		Task Manager
	</div>	
	<?= $this->Flash->render('auth') ?>
	<?= $this->Form->create() ?>	
	<table style="border-spacing:0px">
		<tr>
			<td style="padding:0px">
			</td>
		</tr>
		<tr>
			<td class="divLogin">
			</td>
			<td style="padding:0px">
				<?= $this->Form->input('username', array( 'label' => false, 'placeholder' => 'Login' )) ?>
			</td>
		</tr>
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td class="divPass">
			</td>
			<td style="padding:0px">
				<?= $this->Form->input('password', array( 'label' => false, 'placeholder' => 'Senha' )) ?>
			</td>
		</tr>
		<tr>
			<td style="padding:0px">
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<?= $this->Form->button(__('Login'), ['class'=>'inputLogin']); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="newAccount">
					Crie uma nova conta <a href="/Users/Add"><u style="color:#2C9DFF !important">aqui</u></a>
				</div>
			</td>
		</tr>
	</table>	
	<?= $this->Form->end() ?>
</div>