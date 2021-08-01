<?php
  require_once("../controller/controller_get.php"); 
$t = new controller_get();

// $page = $_POST["page"];
// $t->getAllVocabulary($page)
// echo $t->getAllVocabulary(9);
if ( isset($_POST['page']) ){
	echo $t->getAllVocabulary($_POST['page']);

}else {
	echo "No ok !";
}

?>
