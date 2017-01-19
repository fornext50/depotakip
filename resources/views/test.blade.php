<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test SAyfası</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<?php
		if(DB::connection()->getPDO()){
			echo "Başarılı";
		}
	?>
</body>
</html>