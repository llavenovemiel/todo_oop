<?php 
	class Todo {
		public $id;
		public $content;

		public function setContent($content) {
			$this->content = $content;
		}

		public function setId() {
			if (isset($_SESSION["todos"])) {
				$currentToDoCount = count($_SESSION["todos"]);
				$idOfLastToDo = $_SESSION["todos"][$currentToDoCount - 1]->id;
				$idOFNewToDo = $idOfLastToDo + 1;
			} else {
				$idOFNewToDo = 1;
			}
			$this->id = $idOFNewToDo;
		}

		//modify this function
		public function save() {		
			$_SESSION["todos"][] = $this;
		}

		public function delete() {
			$currentArray = $_SESSION["todos"];
			$currentToDoCount = count($currentArray);
			for ($index = 0; $index < $currentToDoCount; $index++) {
				if ($currentArray[$index]->id == $this->id) {
					unset($currentArray[$index]);
					$_SESSION["todos"] = array_values($currentArray);
					break;
				}
			}
		}

		public static function find($id) {
			$currentToDoCount = count($_SESSION["todos"]);
			$todo = null;
			for ($index = 0; $index < $currentToDoCount; $index++) {
				if (isset($_SESSION["todos"][$index])) {
					if ($_SESSION["todos"][$index]->id == $id) {
						$todo = $_SESSION["todos"][$index];
					}	
				}
			}
			return $todo;
		}		
	}
 ?>