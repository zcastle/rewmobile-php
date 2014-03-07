<?php

    require_once 'lib/dbapdo.class.php';

if ($_POST) {
    $conn = new dbapdo();
    try {
        $conn->beginTransaction();
        $data = json_decode($_POST["data"]);

        $valueSuccess = "";

        //echo json_encode(array("success" => $data));
        //die();
    	
    	$query01="insert into m_atenciones(nroatencion,mozo,idproducto,producto,cantidad,
                precio,fecha,hora,pax,fl_mensaje,total,pc,usuario,co_destino, stado) 
                values(?, ?, ?, ?, ?,?, curdate(), curtime(), ?, ?, ?, 'TABLET', 'TABLET',?, 0)";
        $stmt01 = $conn->prepare($query01);

        $nmesa=null;    $nmozo=null;    $idprod=null;
        $prod=null;     $co_destino=null; $mnsg=null;
        $cant=null;     $precio=null;   $pax=null;
        $tot=null;      
        
        $u = "SELECT no_producto FROM m_productos WHERE id = ?;";
        $stmtU = $conn->prepare($u);

    	$nmesa=$data->nmesa;
        $nmozo=$data->nmozo;
        $idprod=$data->idprod;
        $cant=$data->cant;
        $precio=$data->precio;
        $pax=$data->pax;
        $co_destino=$data->co_destino;
        //$mnsg=$data->mnsg == "" ? " " : $data->mnsg;
        $mnsg=$data->mnsg;
        $tot=$precio*$cant;

        $stmtU->bindParam(1, $idprod);
        $stmtU->execute();
        $rowsU = $stmtU->fetch(PDO::FETCH_OBJ);
        $prod=$rowsU->no_producto;

    	$stmt01->bindParam(1, $nmesa);
        $stmt01->bindParam(2, $nmozo);
        $stmt01->bindParam(3, $idprod);
        $stmt01->bindParam(4, $prod);
        $stmt01->bindParam(5, $cant);
        $stmt01->bindParam(6, $precio);
        $stmt01->bindParam(7, $pax);
        $stmt01->bindParam(8, $mnsg);
        $stmt01->bindParam(9, $tot);
        $stmt01->bindParam(10, $co_destino);

        $queryCount="SELECT COUNT(*) as fl_exist FROM m_atenciones WHERE nroatencion='$nmesa' AND idproducto='$idprod' AND producto='$prod'";
        $stmtCount = $conn->prepare($queryCount);
        $stmtCount->execute();
        $rows = $stmtCount->fetch(PDO::FETCH_OBJ);

        if ($rows->fl_exist > 0) {

            $queryCount2="SELECT COUNT(*)  as fl_exist FROM m_atenciones WHERE nroatencion='$nmesa' AND idproducto='$idprod' AND producto='$prod' AND fl_envio='N'";
            $stmtCount2 = $conn->prepare($queryCount2);
            $stmtCount2->execute();
            $rows2 = $stmtCount2->fetch(PDO::FETCH_OBJ);

            if ($rows2->fl_exist > 0) {
                $query02 = "UPDATE m_atenciones set cantidad = cantidad + 1, total=precio * (cantidad + 1)
                          WHERE nroatencion = '$nmesa' AND idproducto = '$idprod' and producto = '$prod'";
                $stmt02 = $conn->prepare($query02);
                $stmt02->execute();
                $valueSuccess = "update id exist";

            } else {
                $stmt01->execute();
                $valueSuccess = "insert id exist";
            }
        } else {
            $query03="update m_cbzaten set fl_sta=1 where n_ate='$nmesa'";
            $stmtup = $conn->prepare($query03);
            $stmtup->execute();
            
            $stmt01->execute();
            $valueSuccess = "insert id new";
    	
        }
        $conn->commit();
        $id = $conn->lastInsertId();
        echo json_encode(array("success" => true, "message" => $valueSuccess, "idatencion" => $id));
    } catch(PDOException $e) {
        $conn->rollBack();
        echo json_encode(array("success" => false, "error"=>$e->getMessage()));
    }
} else {
    echo 'horror';
}
?>