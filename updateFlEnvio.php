<?php
     require_once 'lib/dbapdo.class.php';
    if ($_POST) {
		$conn = new dbapdo();
		$data = json_decode($_POST["data"]);

		$query = "update m_atenciones set fl_envio='S' where nroatencion=? and co_destino=?";
		$stmtUpdate = $conn->prepare($query);
		
		$mesa=null;
		$destino=null;
		
		$stmtUpdate->bindParam(1, $mesa);
		$stmtUpdate->bindParam(2, $destino);
		
		$mesa=$data->mesa;
		$destino=$data->destino;
		
		$stmtUpdate->execute();
		//$result = $stmtUpdate->fetchAll(PDO::FETCH_CLASS);
		echo json_encode(array("success: update line" => true));
	} else{
		echo json_encode(array("Error"));
	}
	
?>