<?php
	include "database.php";
	
	//Set question number
	if(isset($_GET["n"])){
		$number=(int)$_GET["n"];
	}
	else $number=1;
	
	//Get question
	$query="select * from questions where question_number=".$number;
	//Get result
	$result=$mysqli->query($query) or die($mysqli->error.__LINE__);
	
	$question=$result->fetch_assoc();
	
	//Get choices
	$query="select * from choices where question_number=".$number;
	//Get result
	$choices=$mysqli->query($query) or die($mysqli->error.__LINE__);
	
	$query="select * from questions";
	//Get results
	$results=$mysqli->query($query) or die($mysqli->error.__LINE__);
	$total=$results->num_rows;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>PHP Quizzer</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
	<header>
		<div class="container">
			<h1>PHP Quizzer</h1>
		</div>
	</header>
	<main>
		<div class="container">
			<div class="current">Question <?php echo $question["question_number"]; ?> of <?php echo $total; ?></div>
			<p class="question">
				<?php
					echo $question["text"];
				?>
			</p>
			<form method="post" action="process.php">
				<ul class="choices">
				<?php
					while($row=$choices->fetch_assoc()){
						echo "<li><input name='choice' type='radio' value=".$row["id"].">".$row["text"]."</li>";
					}
				?>
				</ul>
				<input type="submit" name="submit" value="Submit" />
				<input type="hidden" name="number" value="<?php echo $number; ?>" />
			</form>
		</div>
	</main>
	<footer>
		<div class="container">
			Copyright &copy; 2020, PHP Quizzer
		</div>
	</footer>
</body>
</html>