<?php

// Desativar a exibição de avisos
ini_set('error_reporting', E_ALL & ~E_NOTICE);

require_once("class/Database.class.php");
$con = Database::getConexao();


$acao = $_REQUEST['acao'];
$return = array();


if ($acao == "listar") {
    $query = "SELECT linha_aerea, 
                    horario_ida, 
                    horario_volta 
                    FROM voos";
    $consulta = $con->prepare($query);
    $consulta->execute();

    while ($data = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $return[] = array(
            "id" => $data["voos"],
            "linha_aerea" => $data["linha_aerea"],
            "horario_ida" => $data["horario_ida"],
            "horario_volta" => $data["horario_volta"]
        );
    }

    $consulta = $con->prepare($query);
    if (!$consulta) {
        die("Erro na preparação da consulta SQL: " . $con->errorInfo());
    }

    $consulta->execute();
    
}

die(json_encode($return));

?>


