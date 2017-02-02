<!DOCTYPE html>
<html>
	<head>
		<title>吉他战争高分表</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<link rel="shortcut icon" type="image/ x-icon" href="">
		<link rel="stylesheet" type="text/css" href="style/style.css">
	</head>
	<body>
		<h1>吉他战争排行榜</h1>
		<p>欢迎来到吉他战争！你想将自己获得的分数添加到榜单中吗？<a href="add.php">添加分数</a></p>
		<div class="line"></div>
		<?php
			require_once('sitevars.php');
			$dbc = mysqli_connect("localhost", "root", "root", "highscore"); //将地址、MySQL账号密码数据库名称储存在dbc中
			$query = "SELECT * FROM scorelist ORDER BY score DESC, date ASC";
			$data = mysqli_query($dbc, $query); //链接并执行操作后的数据储存在data中

			echo "<table>"; //表格起始
			while ($row = mysqli_fetch_array($data)) { //循环访问数据行
				echo "<tr><td class='scoreinfo'>"; //输出行
				echo "<span class='score'>" . $row['score'] . "</span><br />"; //输出分数
				echo "<strong>Name:</strong>" . $row['name'] . "<br />"; //输出姓名
				echo "<strong>Date:</strong>" . $row['date'] . "</td>"; //输出日期
				if (is_file(GW_UPLOADPATH . $row['pic'])) {
					echo '<td><img src="image/' . $row['pic'] . '" alt="截图文件"></td></tr>';
				}else{
					echo '<td><img src="image/no.jpg" alt="无截图"></td></tr>';
				}
			}
			echo "</table>"; //表格结束

			mysqli_close($dbc); //关闭数据库
		?>
	</body>
</html>
