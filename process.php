<?php
	include "database.php";
	session_start();
	
	//Check to see if score is set
	if(!isset($_SESSION["score"])){
		$_SESSION["score"]=0;
	}
	
	if(isset($_POST["submit"])){
		$number=$_POST["number"];
		$selected_choice=$_POST["choice"];
		$next=$number+1;
		
		//Get total questions
		$query="select count(question_number) as num from questions";
		$result=$mysqli->query($query) or die($mysqli->error.__LINE__);
		$total=$result->fetch_assoc()["num"];
		
		//Get correct choice
		$query="select * from choices where question_number=".$number." and
		is_correct=1";
		
		//Get result
		$result=$mysqli->query($query) or die($mysqli->error.__LINE__);
		
		//Get row
		$row=$result->fetch_assoc();
		
		//Set correct choice
		$correct_choice=$row["id"];
		
		//Compare
		if($correct_choice==$selected_choice){
			//Answer is correct
			$_SESSION["score"]++;
		}
		
		//Check if last question
		if($number==$total){
			header("location: final.php");
			exit();
		}
		else{
			header("location: question.php?n=".$next);
		}
	}
?>