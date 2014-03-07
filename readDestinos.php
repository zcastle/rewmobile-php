<?php
require_once 'lib/dbapdo.class.php';
    $conn = new dbapdo();
    $query = "select co_destino,no_destino,no_imp from m_destinos";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "data" => $result
    ));
?>