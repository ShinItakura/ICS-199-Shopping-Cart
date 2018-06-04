<?php
session_start(); //start session
include('mysqli_connect.php');
include 'header.php';

?>

<br>

<div align="center">
<form action="index.php" method="GET">
	<p class="b">Axle: <select name="axle">
		<option value="0">All</option>
		<option value="1">Ball Bearing</option>
		<option value="2">Fixed</option>
		<option value="3">Transaxle</option>
	</select>
	Material: <select name="mat">
		<option value="0">All</option>
		<option value="1">Metal</option>
		<option value="2">Plastic</option>
		<option value="3">Wood</option>
	</select>
	Shape: <select name="shape">
		<option value="0">All</option>
		<option value="1">Butterfly</option>
		<option value="2">Classic</option>
		<option value="3">Imperial</option>
		<option value="4">Modified</option>
	</select>
	<input type="submit" value="Submit"/>
	</p>
</form>
</div>

<?php
//	ini_set('display_errors',1);
$axleChoice = $_GET['axle'];
$matChoice = $_GET['mat'];
$shapeChoice = $_GET['shape'];
$query ="SELECT * FROM ITEM";
$previous = false;
if ($axleChoice != 0) {
$query .= " WHERE AXLE_id = $axleChoice";
$previous = true;
}
if ($matChoice != 0) {
if ($previous) {
	$query .= " AND MATERIAL_id = $matChoice";
} else {
	$query .= " WHERE MATERIAL_id = $matChoice";
}
$previous = true;
}
if ($shapeChoice != 0) {
if ($previous) {
//	$query = "SELECT * FROM ITEM WHERE AXLE_id = $axleChoice AND SHAPE_id = $shapeChoice";
	$query .= " AND SHAPE_id = $shapeChoice";
} else {
//	$query = "SELECT * FROM ITEM WHERE SHAPE_id = $shapeChoice";
	$query .= " WHERE SHAPE_id = $shapeChoice";
}
}
$result = mysqli_query($dbc, $query);


//Display fetched records as you please
$item =  '<ul class="products-wrp">';

while($row = $result->fetch_assoc()) {
$item .= <<<EOT
<li>

   <form class="form-item">
    <p class="a">{$row["name"]}</p>
     <div><img src="images/{$row["image"]}"></div>
     <div>Price : {$currency} {$row["price"]}<div>
<div class="item-box">
	<div> Qty :
    <input type="number" min="0" value="1" name="quantity" style="width: 5em;" required>
	</div>
    <input name="id" type="hidden" value="{$row["id"]}">
    <button type="submit">Add to Cart</button>

</div>
</form>
</li>
EOT;

}
$item .= '</ul></div>';

echo $item;
include('footer.php');
?>
