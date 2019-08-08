<?php
//include"../seguranca/seguranca.php";
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set( 'America/Sao_Paulo' );
require('fpdf/alphapdf.php');
require('PHPMailer/class.phpmailer.php');

require_once '../seguranca/Conexao.php';
require_once '../seguranca/Log.php';

define('LOCAL_AG', 'DAOCurso.php');


try {
    $sql = "SELECT aluno.nome as nome, email, matricula, curso.nome as cursonome, curso.data, carga_horaria from alunocurso,curso,aluno WHERE alunocurso.idAluno=aluno.idAluno and alunocurso.idCurso = curso.idCurso and aluno.idAluno = ? and curso.idCurso=? ";
    $stmt = Conexao::getInstance()->prepare($sql);
    $stmt->bindParam(1, $_GET['idAluno']);
    $stmt->bindParam(2, $_GET['idCurso']);
    $stmt->execute();
    Log::getInstance()->inserir(LOCAL_AG,"SELECT na tabela `aluno` executada...");

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $email    = $result['email'];
        $nome     = utf8_decode($result['nome']);
        $cpf      = $result['matricula'];
        $curso    = utf8_decode($result['cursonome']);
        $data     = date('d-m-Y', strtotime($result['data']));
        $carga_h  = $result['carga_horaria']." horas";
    }
                            
} catch (Exception $e) {
    Log::getInstance()->inserir(LOCAL_AG,"Erro - " . $e->getCode() . " - " . $e->getMessage());
    echo"<script>
                            alert('Erro - $code - $message.');
                            window.location.href='../listar/listCurso.php';
                            </script>";
}
//
//
$texto1 = utf8_decode("Certificamos que $nome");
$texto2 = utf8_decode("participou de $curso no dia $data na III Maratona de Minicursos e Palestras AeroBeetle, durante os dias 19 e 20 de outubro de 2018, realizado na FACULDADE PITÁGORAS – TURU, com carga horária de ".$carga_h." horas.");
$texto3 = utf8_decode("São Luis, ".utf8_encode(strftime( '%d de %B de %Y', strtotime( date( 'Y-m-d' ) ) )));
$pdf = new AlphaPDF();
// Orientação Landing Page ///
$pdf->AddPage('L');
$pdf->SetLineWidth(1.5);
// desenha a imagem do certificado
$pdf->Image('certificado.jpg',0,0,295);
// opacidade total
$pdf->SetAlpha(1);
// Mostrar texto no topo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(109,78); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto1, '', 'L', 0); // Tamanho width e height e posição
// Mostrar o nome
//$pdf->SetFont('Arial', '', 30); // Tipo de fonte e tamanho
//$pdf->SetXY(20,92); //Parte chata onde tem que ficar ajustando a posição X e Y
//->MultiCell(265, 10, $nome, '', 'C', 0); // Tamanho width e height e posição
// Mostrar o corpo
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(20,110); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(265, 10, $texto2, '', 'C', 0); // Tamanho width e height e posição
// Mostrar a data no final
$pdf->SetFont('Arial', '', 15); // Tipo de fonte e tamanho
$pdf->SetXY(32,172); //Parte chata onde tem que ficar ajustando a posição X e Y
$pdf->MultiCell(165, 10, $texto3, '', 'L', 0); // Tamanho width e height e posição
$pdfdoc = $pdf->Output('', 'S');
// ******** Agora vai enviar o e-mail pro usuário contendo o anexo
// ******** e também mostrar na tela para caso o e-mail não chegar
$subject = 'Seu Certificado do AeroBeetle';
$messageBody = "Olá $nome<br><br>É com grande prazer que entregamos o seu certificado.<br>Ele está em anexo nesse e-mail.<br><br>Atenciosamente,<br>Equipe AeroBeetle<br><a href='http://www.lnborges.com.br'>http://www.lnborges.com.br</a>";
$mail = new PHPMailer();
$mail->SetFrom("aerobeetle@ns01.000webhost.com", "Certificado");
$mail->Subject  = $subject;
$mail->MsgHTML(utf8_decode($messageBody));	
$mail->AddAddress($email); 
$mail->addStringAttachment($pdfdoc, 'Certificado.pdf');
$mail->Send();
$pdf->Output();
?>