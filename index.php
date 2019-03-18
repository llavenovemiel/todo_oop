<?php 
	require_once("Todo.php");
	session_start();
	if (isset($_SESSION["todos"])) {
		$todos = $_SESSION["todos"];
	} else {
		$todos = [];
	}
	print_r($todos);
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>To Do</title>
</head>
<body>
	<main style="width: 50%; margin: 0 auto">
		<h1 style="text-align: center;">To Do List</h1>
		<form action="submit.php" method="post">
			<div style="text-align: center;">
				<input id="add" type="text" name="content">
				<button type="submit" name="add">Add To Do</button>
			</div>
			<ul style="padding-left: 0">
				<?php foreach ($todos as $todo) { 
					$todoArray = (array) $todo;
				?>
				
					<li style="display: flex; flex-direction: row; justify-content: space-between; list-style: none; margin-bottom: 4px">
						<span>
							<?php echo $todoArray["content"]; ?>
						</span>
						<span>
							<button type="button" id="<?php echo $todoArray["id"]; ?>" class="edit">Edit</button>
							<button type="submit" name="delete" value="<?php echo $todoArray["id"]; ?>">Delete</button>
						</span>
					</li>
					
				<?php } ?>
			</ul>
		</form>
		
	</main>
	<script type="text/javascript">
		function edit() {
			
			let content = this.parentElement.parentElement.children[0].innerHTML.trim();
			let id = this.id;
			
			let inputHtml =	`<input id="edit" type="text" name="content" value="${content}">
							<button type="submit" name="edit" value="${id}">Save</button>
							`;

			const holder = this.parentElement.parentElement.children[0].innerHTML = inputHtml;

			document.getElementById("edit").onkeypress = preventSubmitOnEnter;
		};

		const editButtons = Array.from(document.getElementsByClassName("edit"));
		editButtons.forEach((editButton) => {
			editButton.onclick = edit;
		});

		const preventSubmitOnEnter = e => {
			var key = e.charCode || e.keyCode || 0;     
			if (key == 13) {
				e.preventDefault();
			}
		}

		document.getElementById("add").onkeypress = preventSubmitOnEnter;

	</script>
</body>
</html>