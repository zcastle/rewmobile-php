<?php
require_once 'lib/dbapdo.class.php';
    $conn = new dbapdo();
    $query = "select p.co_categoria,c.no_categoria,p.id,p.no_producto,p.precio0,p.nu_orden,p.co_destino
              from m_productos p inner join m_categorias c on p.co_categoria=c.co_categoria
              where p.fl_eliminado<>'S' order by no_producto";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "data" => $result
    ));
?>