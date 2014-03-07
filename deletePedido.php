<?php

    require_once 'lib/dbapdo.class.php';
	

if ($_POST) {
	$conn = new dbapdo();
	$data = json_decode($_POST["data"]);
    
	$query01="delete from m_atenciones where idatencion=?";
	$stmtDel = $conn->prepare($query01);
	
	$id=null;
    
	$stmtDel->bindParam(1, $id);
	$id=$data->id;
	
	$queryCount="SELECT * FROM m_atenciones WHERE idatencion='$id'";
	$stmtCount = $conn->prepare($queryCount);
	$stmtCount->execute();
	$rows = $stmtCount->fetch(PDO::FETCH_OBJ);
	
	$nmesa=$rows->nroatencion;
	$queryCount="";
	$queryCount="select count(*) as COUNT from m_atenciones where nroatencion=$nmesa";
	$stmtCount = $conn->prepare($queryCount);
	$stmtCount->execute();
	$rows = $stmtCount->fetch(PDO::FETCH_OBJ);
	
	if ($rows->COUNT > 1) {
		$stmtDel->execute();
		echo json_encode(array("success : delete line" => true, "id" =>$id));
	} else {
		$query02="update m_cbzaten set fl_sta=0 where n_ate=$nmesa";
		$stmtup = $conn->prepare($query02);
		$stmtup->execute();
		
		$stmtDel->execute();
		echo json_encode(array("success : delete line and clear" => true, "id" =>$id));
	}
} else {
	echo 'horror';
}

?>