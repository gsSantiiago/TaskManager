<!-- File: src/Template/Users/index.ctp -->

<table style="border-spacing: 0px; padding-bottom: 90px;">
    <tr>
        <th>Id</th>
        <th>Nome</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td>
			<div><?= $user->id ?></div>
		</td>
		<td>
			<div><?= $user->name ?></div>
		</td>
    </tr>
    <?php endforeach; ?>
</table>