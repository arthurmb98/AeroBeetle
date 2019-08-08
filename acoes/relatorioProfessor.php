<?php
error_reporting(0);
ini_set('display_errors', 0 );
require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';

define('LOCAL_ARP', 'relatiorioProfessor.php');

try {
    $sql = "SELECT professor.nome as Nome, curso.nome as Curso  FROM professorcurso, professor, curso WHERE professorcurso.idProfessor = professor.idProfessor
    and professorcurso.idCurso = curso.idCurso";
    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->execute();
    Log::getInstance()->inserir(LOCAL_ARP,"SELECT na tabela `professorcurso` executada...");
    $html[0] = "";
    $html[0] .= "<table>";
    $html[0] .= "<tr>";
    $html[0] .= "<td><b>Nome</b></td>";
    $html[0] .= "<td><b>Curso</b></td>";
    $html[0] .= "</tr>";
    $html[0] .= "</table>";
    $i=1;
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nome = $result['Nome'];
        $curso = $result['Curso'];
        $html[$i] = "";
        $html[$i] .= "<table>";
        $html[$i] .= "<tr>";
        $html[$i] .= "<td>$nome</td>";
        $html[$i] .= "<td>$curso</td>";
        $html[$i] .= "</tr>";
        $html[$i] .= "</table>";
        $i++;
    }
    $arquivo = 'Relatorio-Professor.xls';
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type: application/x-msexcel");
    header ("Content-Disposition: attachment; filename={$arquivo}" );
    header ("Content-Description: PHP Generated Data" );
    
    for($indice=0;$indice<=$i+1;$indice++){  
        echo $html[$indice];
    }

} catch (Exception $e) {
    Log::getInstance()->inserir(LOCAL_ARA,"Erro - " . $e->getCode() . " - " . $e->getMessage());
}





?>