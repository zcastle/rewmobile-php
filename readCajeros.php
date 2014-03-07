<?php
	require_once 'lib/dbapdo.class.php';
    	$conn = new dbapdo();

	$query = "select id, no_usuario, ap_usuario, co_usuario, pw_usuario 
		   from m_usuarios u
                 where fl_eliminado='N' AND id_rol = 2";

	$stmtRead = $conn->prepare($query);
	$stmtRead->execute();
    	$result = $stmtRead->fetchAll(PDO::FETCH_CLASS);
	echo json_encode(array("data" => $result));//}
?>