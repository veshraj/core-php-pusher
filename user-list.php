<?php
require_once './vendor/autoload.php';

use Classes\DB;

$list = DB::select('select * from users ');

foreach ($list as $item) {
	echo '<tr>';
		echo '<td>'.$item->name.'</td>';
		echo '<td>'.$item->email.'</td>';
		echo '<td>'.$item->phone.'</td>';
	echo '</tr>';
}
