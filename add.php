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
		<h1>添加您的分数至吉他战争排行榜</h1>
		<?php
			require_once('sitevars.php'); //引入变量文件
			if (isset($_POST['submit'])) { //如果提交状态为POST
				$name = $_POST['name']; 
				$score = $_POST['score'];
				$file = time() . $_FILES['pic']['name'];
				$filetype = $_FILES['pic']['type'];
				$filesize = $_FILES['pic']['size'];

				if (!empty($name) && !empty($score) && !empty($file)) { //如果名字、分数、文件都不为空
					if ((($filetype == 'image/jpeg') || ($filetype == 'image/pjpeg') || ($filetype == 'image/gif') || ($filetype == 'image/png')) && ($filesize > 0) && ($filesize <= MAXFILESIZE)) {
					//限制文件格式与大小
						$target = GW_UPLOADPATH . $file;
						if (move_uploaded_file($_FILES['pic'] ['tmp_name'], $target)) { //将图片文件从临时文件夹移动至项目文件夹
							$dbc = mysqli_connect('localhost', 'root', 'root', 'highscore');
							$query = "INSERT INTO scorelist VALUES (0 , '$name', NOW(), '$score', '$file')";
							//将主键、姓名、时间、分数、图像文件名储存至数据库
							mysqli_query($dbc, $query);

							echo "<p>Thanks for adding your new high score!</p>";
							echo "<p><strong>Name:</strong>" . $name . "<br />";
							echo "<strong>Score:</strong>" . $score . "<br />";
							echo '<img src="' . GW_UPLOADPATH . $file . '" alt="截图文件" /></p>';
							echo "<p><a href='index.php'>Back</a>";
							//输出回馈信息
							$name = '';
							$score = '';
							mysqli_close($dbc);
						}else{
							echo "<p class='error'>Please enter all of the information to add" . "your high score.</p>";
						}
					}else{
						echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
					}
				}
			}
		?>
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="32768">
			<label for="name">姓名：</label>
			<input type="text" id="name" name="name" value="<?php if (!empty($name)) echo $name; ?>"><br>
			<label for="score">分数</label>
			<input type="text" id="score" name="score" value="<?php if (!empty($score)) echo $score; ?>"><br>
			<label for="pic">屏幕截图：</label>
			<input type="file" id="pic" name="pic"><br>
			<input type="submit" name="submit" value="Add">
		</form>
	</body>
</html>