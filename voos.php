<?php

// Desativar a exibição de avisos
error_reporting(E_ERROR);

require_once("assets/tabela.css");
function api(){
    $url = "http://localhost:8888/api.php?acao=listar";
    $response = file_get_contents($url);

    if ($response !== false) {
        return ($response);
    } else {
        return "Falha ao acessar a API.";
    }
}

$resultado = api();

echo "<table>";
echo "<tr><th>Linha Aérea</th><th>Horário de Ida</th><th>Horário de Volta</th></tr>";

if (is_object($resultado) && property_exists($resultado, 'voo')) {
    $voos = $resultado->voo;
    
    foreach ($voos as $item) {
        echo "<tr>";
        echo "<td>" . $item->linha_aerea . "</td>";
        echo "<td>" . $item->horario_ida . "</td>";
        echo "<td>" . $item->horario_volta . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>$resultado</td></tr>";
}

echo "</table>";
echo '<input type="text" class="form-control" id="linha_aerea" name="linha_aerea" aria-label="Titulo da meta" required />';

?>

