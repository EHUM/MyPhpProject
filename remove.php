<!DOCTYPE html>
<html>
	<head>
		<title>吉他战争高分表_删除</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="shortcut icon" type="image/ x-icon" href="">
		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>
	<body>
		<h1>吉他战争排行榜</h1>
		<p>Below is alist of all Guitar Wars high score, Use this page to remove score as needed.</p>
		<div class="line"></div>
		<table style="border: 1px solid #333;">
			<thead>
				<tr>
					<td style="border: 1px solid #333; text-align: center;">ID</td>
					<td style="border: 1px solid #333; text-align: center;">date</td>
					<td style="border: 1px solid #333; text-align: center;">name</td>
					<td style="border: 1px solid #333; text-align: center;">score</td>
					<td style="border: 1px solid #333; text-align: center;">pic</td>
					<td style="border: 1px solid #333; text-align: center;">删除</td>
				</tr>
			</thead>
			<?php
				require_once('sitevars.php');
				$dbc = mysqli_connect("localhost", "root", "root", "highscore");
				$query = "SELECT * FROM scorelist ORDER BY score DESC, date ASC";
				$data = mysqli_query($dbc, $query);

				while ($row = mysqli_fetch_array($data)) {
					echo "<tr>";
					echo "<td style='border: 1px solid #333; text-align: center;'>" . $row['id'] . "</td>";
					echo "<td style='border: 1px solid #333; text-align: center;'>" . $row['date'] . "</td>";
					echo "<td style='border: 1px solid #333; text-align: center;'>" . $row['name'] . "</td>";
					echo "<td style='border: 1px solid #333; text-align: center;'>" . $row['score'] . "</td>";
					echo "<td style='border: 1px solid #333; text-align: center;'>" . $row['pic'] . "</td>";
					echo "<td style='border: 1px solid #333; text-align: center;'><a href='removescore.php?id=" . $row['id'] . "&amp;date=" . $row['date'] . "&amp;name=" . $row['name'] . "&amp;score=" . $row['score'] . "&amp;pic=" . $row['pic'] . "'>Remove</a></td></tr>";
				}
			?>
			<!-- <tr>
				<td style="border: 1px solid #333;">1</td>
				<td style="border: 1px solid #333;">2008-04-22 14:47:22</td>
				<td style="border: 1px solid #333;">Ehum</td>
				<td style="border: 1px solid #333;">32308272</td>
				<td style="border: 1px solid #333;">none</td>
			</tr> -->
		</table>
	</body>
</html>