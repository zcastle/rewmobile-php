<?php
//http://10.10.10.20:8080/rewmobile/createCategoria.php?m_fuente=[{%22impresora%22:%22uno%22,%22fuente%22:%22dos%22},{%22impresora%22:%22tres%22,%22fuente%22:%22cuatro%22}]
//http://10.10.10.20:8080/rewmobile/createCategoria.php?m_fuente=[{%22impresora%22:%22uno%22,%22fuente%22:%22dos%22}]

/*
mandar registro de uno en uno al momento de añadir igual al update, no esperar al enviar

mandar linea, este devuelve success

mandar enviar

1 to 10{
    if print {
	if not send {
	    .php?co_producto=100011
	}
	change backcolor
    }
}

pedido:
idatencion [correlativo para linea}
nu_mesa
co_mozo
nu_pax
co_producto
no_producto
ca_producto
va_producto
fl_enviado N or S
no_mesas_unidas [20-10-2] or 0
no_mesa_ant [10] or 0

*/

    require_once 'lib/dbapdo.class.php';
    $conn = new dbapdo();

    $data = json_decode($_GET["m_fuente"]);

    $query = "insert into m_fuente(impresora, fuente) values(?, ?)";
    $stmt = $conn->prepare($query);
    
    $impresora = null; $fuente = null;

    $stmt->bindParam(1, $impresora);
    $stmt->bindParam(2, $fuente);

    foreach($data as $linea){
	$impresora = $linea->impresora;
	$fuente = $linea->fuente;
    	$stmt->execute();
    }

    //$result = $stmt->fetchAll();
    //$result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "success" => true
    ));
?>