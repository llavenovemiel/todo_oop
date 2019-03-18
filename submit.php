<?php 
	require_once("Todo.php");
	session_start();
	
	if ($_POST["content"] && isset($_POST["add"])) {
		$content = $_POST["content"];
		$todo = new Todo;
		$todo->setContent($content);
		$todo->setId();
		$todo->save();
	} else if (isset($_POST["delete"])) {
		$id = $_POST["delete"];
		$todo = Todo::find($id);
		$todo->delete();
		$todo = Todo::find($id);
	} else if (isset($_POST["edit"])) {
		$id = $_POST["edit"];
		$content = $_POST["content"];
		$todo = Todo::find($id);
		$todo->setContent($content); //object is passed by reference
	}
	

	header('Location: index.php');
 ?>