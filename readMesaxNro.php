<?php
     require_once 'lib/dbapdo.class.php';
    $tip=$_GET["t"];
    $conn = new dbapdo();
   	$query = "SELECT idatencion,usuario,mozo,idproducto,producto,cantidad,precio,pax,
	          co_destino,fl_mensaje as mensaje, stado, fl_envio from m_atenciones where nroatencion=$tip";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "data" => $result
    ));
?>