<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['delete']))
    {
		require_once '../connection.php'; 
		$id = $_POST["id"];
		
		$con->query("delete from produits where $id ");
		echo "<script>window.location.href='index.php';</script>";
		die;
    }
?>