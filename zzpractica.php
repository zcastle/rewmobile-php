<?php
    require_once 'lib/dbapdo.class.php';
    $conn = new dbapdo();

    $data = json_decode($_GET["m_fuente"]);

    $query="insert into m_atenciones(nroatencion,mozo,idproducto,producto,cantidad,precio,
                                     fecha,hora,pax,co_destino,fl_mensaje,total,pc,usuario) 
			      values(?,?,?,?,?,?,curdate(),curtime(),?,?,?,?,'TABLET','TABLET')";
    $stmt = $conn->prepare($query);

    $nmesa=null; $nmozo=null;      $idprod=null; $prod=null;
    $cant=null;  $precio=null;     $pax=null;    $cod_dest=null;
    $mnsg=null;  $tot=null;	 

    $stmt->bindParam(1, $nmesa);
    $stmt->bindParam(2, $nmozo);
    $stmt->bindParam(3, $idprod);
    $stmt->bindParam(4, $prod);
    $stmt->bindParam(5, $cant);
    $stmt->bindParam(6, $precio);
    $stmt->bindParam(7, $pax);
    $stmt->bindParam(8, $cod_dest);
    $stmt->bindParam(9, $mnsg);
    $stmt->bindParam(10, $tot);

    $nmesa=$data->nmesa;
    $nmozo=$data->nmozo;
    $idprod=$data->idprod;
    $prod=$data->prod;
    $cant=$data->cant;
    $precio=$data->precio;
    $pax=$data->pax;
    $cod_dest=$data->cod_dest;
    $mnsg=$data->mnsg;
    $tot=$precio*$cant;
    $stmt->execute();

    echo json_encode(
            array(
                "success dfdf " => true
    ));
?>
