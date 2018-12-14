<?php
$taskManagerDescription = 'TaskManager';
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $taskManagerDescription ?>:
			<?= $this->fetch('title') ?>
		</title>
		<?= $this->Html->meta('icon') ?>

		<?= $this->Html->css('style.css') ?>
		<?= $this->Html->css('custom.css') ?>		

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>
	</head>
	<body>	
		<?= $this->Flash->render() ?>		
		<div class="app">		
			<?= $this->fetch('content') ?>		
		</div>
	</body>
</html>
