<?php
 header('Content-type: text/html; charset=utf-8'); 
mysql_connect("localhost","root","");
mysql_select_db("skyeng");
if (isset($_GET["username"])){
	$username = $_GET["username"];
	$phone = $_GET["phone"];
	$status = $_GET["status"];
	$query = "INSERT INTO users (`username`,`phone`,`status`,`time`) values ('$username','$phone','$status',NOW())";
	mysql_query($query);
}
else if (isset($_GET["change_status"])){
	$query = "UPDATE users SET status='".$_GET["status"]."' WHERE id=".$_GET["id"];
	mysql_query($query);
}
$result = mysql_query("SELECT * FROM users");
$num = mysql_num_rows($result);
?>
<table border="1px" cellpadding="5" cellspacing="0">
<?php
for ($i=0;$i<$num;$i++){
	$row = mysql_fetch_array($result);
	echo "<tr></tr><td>".$row["username"]."</td><td>".$row["status"]."</td>";
	?>
	<td><form action="page1.php">
		<select name="status">
			<option value="new">новый</option>
			<option value="registered">зарегистрирован</option>
			<option value="rejected">отказался</option>
			<option value="unavailable">недоступен</option>
		</select>
		<input type="hidden" name="change_status" value="1"/>
		<input type="hidden" name="id" value="<?= $row["id"] ?>"/>
		<input type="submit" value="поменять статус"/>
		</form>
	</td></tr>
	<?
	
}
?>

</table>

<hr/>
<form action="page1.php" method="get">
<label>Пользователь:<input type="text" name="username"></label><br/>
<label>Телефон:<input type="text" name="phone"></label><br/>
<label>Статус:<select name="status">
<option value="new">новый</option>
<option value="registered">зарегистрирован</option>
<option value="rejected">отказался</option>
<option value="unavailable">недоступен</option>
</select></label><br/>
<input type="submit"/>
</form>

