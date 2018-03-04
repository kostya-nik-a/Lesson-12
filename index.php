<?php

$connect = mysqli_connect("localhost","akostyaeva","neto1548","global");
mysqli_set_charset($connect, "utf8");


$str = "";
$where = "";

if (!empty($_POST['isbn']) && $_POST['isbn'] != "") {
	$str .= " isbn like '%".$_POST['isbn']."%'";
}
else {
	$str .= "1=1";
}

if (!empty($_POST['name']) && $_POST['name'] != "") {
	$str .= " and name like '%".$_POST['name']."%'";
}

if (!empty($_POST['author']) && $_POST['author'] != "") {
	$str .= " and author like '%".$_POST['author']."%'";
}

if ($str != "") {
	$where = "where ".$str;
}


$sql = "select * from books " . $where . " order by author";

$result = mysqli_query($connect, $sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test</title>
</head>
<body>
	<h1>Библиотека успешного человека</h1>

	<form method="POST">
    	<input type="text" name="isbn" placeholder="ISBN" value="<?= !empty($_POST['isbn']) ? $_POST['isbn'] : "" ?>">
    	<input type="text" name="name" placeholder="Название книги" value="<?= !empty($_POST['name']) ? $_POST['name'] : "" ?>">
    	<input type="text" name="author" placeholder="Автор книги" value="<?= !empty($_POST['author']) ? $_POST['author'] : "" ?>">
    	<input type="submit" value="Поиск">
	</form>


	<table style="border: 1px solid grey; border-color: grey;">
		<thead style="border: 1px solid grey; background-color: grey;">
		<tr>
			<th>Название книги</th>
			<th>Автор</th>
			<th>Год выпуска</th>
			<th>ISBN</th>
			<th>Жанр</th>
		</tr>
		</thead>

		<tbody>
			<?php
				while ($data = mysqli_fetch_array($result, MYSQLI_NUM)){
				echo "<tr>";
					for ($i = 1; $i < count($data); $i++) {
			?>
			<td><?php echo $data[$i] ?></td>
				<?php 
					}
				echo "</tr>";
				}
			?>
	</tbody>
	</table>

</body>
