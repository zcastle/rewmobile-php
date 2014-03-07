<?php
	require_once 'lib/dbapdo.class.php';

//if ($_POST) {
    $conn = new dbapdo();
//	$id=null;	$t=null;	$psw=null;

//	$data = json_decode($_POST["data"]);
	
//	$t=$data->t;
  //  $id=$data->id;
    //$psw=$data->psw;

	$query = "select u.id,u.no_usuario,u.ap_usuario,u.co_usuario,u.pw_usuario 
		      from m_usuarios u inner join m_roles r on u.id_rol=r.id 
              where fl_eliminado='N'";
	
//	if ($t == 1){
	
		$query .= " and r.fl_pos=102";
		$stmtRead = $conn->prepare($query);
	    $stmtRead->execute();
    	$result = $stmtRead->fetchAll(PDO::FETCH_CLASS);
	    echo json_encode(array("data" => $result));//}
/*	
	else{
		$query .= " and r.fl_pos=111 and u.id=? and u.pw_usuario=md5(?)";
		$stmtRead = $conn->prepare($query);

		$stmtRead->bindParam(1, $id);
		$stmtRead->bindParam(2, $psw);
		
		$stmtRead->execute();
		$rows = $stmtRead->fetchAll(PDO::FETCH_CLASS);
		echo $query;

		if ($rows->num_rows >0){
			echo json_encode(array("success:" => true));}
		else{
			echo json_encode(array("success:" => false));}}
	}
else {
		echo 'horror';}
*/
?>