<?php
error_reporting(0);
ini_set('display_errors', 0 );
require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';

define('LOCAL_ARA', 'relatiorioAluno.php');

try {
    $sql = "SELECT aluno.nome as Nome, 
    aluno.periodo as Periodo, 
    aluno.idGraduacao as Graduacao,
    curso.nome as Curso, 
    curso.idTurno as Turno  
    FROM alunocurso, aluno, curso, professor, professorcurso WHERE alunocurso.idAluno = aluno.idAluno
    and alunocurso.idCurso = curso.idCurso";
    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->execute();
    Log::getInstance()->inserir(LOCAL_ARA,"SELECT na tabela `alunocurso` executada...");
    $html[0] = "";
    $html[0] .= "<table>";
    $html[0] .= "<tr>";
    $html[0] .= "<td><b>Nome</b></td>";
    $html[0] .= "<td><b>Curso</b></td>";
    $html[0] .= utf8_decode("<td><b>Graduaçao</b></td>");
    $html[0] .= utf8_decode("<td><b>Período</b></td>");
    $html[0] .= "<td><b>Turno</b></td>";
    $html[0] .= "</tr>";
    $html[0] .= "</table>";
    $i=1;
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $nome = utf8_decode($result['Nome']);
        $curso = utf8_decode($result['Curso']);
        $graduacao = $result['Graduacao'];
        $periodo = $result['Periodo'];
        $turno = $result['Turno'];
        $html[$i] = "";
        $html[$i] .= "<table>";
        $html[$i] .= "<tr>";
        $html[$i] .= "<td>$nome</td>";
        $html[$i] .= "<td>$curso</td>";
        $html[$i] .= "<td>$graduacao</td>";
        $html[$i] .= "<td>$periodo</td>";
        $html[$i] .= "<td>$turno</td>";
        $html[$i] .= "</tr>";
        $html[$i] .= "</table>";
        $i++;
    }
    $arquivo = 'Relatorio-Aluno.xls';
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