<?

require_once('class.DB.php');
require_once('class.Saveable.php');
require_once('class.Multi_Armed_Bandit.php');
require_once('class.Bandit.php');

if ($_POST) {
	if (array_key_exists('item_id', $_POST))
		Bandit::reward($_POST['item_id']);
}

$sql = 'SELECT id, name, attempts, successes FROM options';
$items = DB::getArray($sql);
$rr = new Bandit($items);

$item = $rr->choose();

?>

<table>
	<thead>
		<th>Color</th>
		<th>Successes</th>
		<th>Attempts</th>
		<th>%</th>
	</thead>
	<tbody>
		<? foreach ($items as $color): ?>
			<tr>
				<td><?= $color['name']; ?></td>
				<td><?= $color['successes']; ?></td>
				<td><?= $color['attempts']; ?></td>
				<td><?= number_format($color['successes'] / $color['attempts'], 2); ?></td>
			</tr>
		<? endforeach ?>
	</tbody>
</table>

<form method="post" action="">
	<input type="hidden" name="item_id" value="<?= $item['id'] ?>"/>
	<button type="submit"><?= $item['name'] ?></button>
</form>

<form method="post" action="">
	<button type="submit">Don't Choose</button>
</form>