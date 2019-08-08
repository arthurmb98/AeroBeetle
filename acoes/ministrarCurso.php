<?php
    require_once '../seguranca/Conexao.php';
    require_once '../seguranca/Log.php';
                    $okay = false;
                    if(isset($_GET['idCurso']) && isset($_GET['idPalestrante'])){
                      
                        try{
                            $sql = "INSERT INTO palestrantecurso(idPalestrante, idCurso, sala) VALUES (?,?,?)";
                            $stmt = Conexao::getInstance()->prepare($sql);
                            $stmt->bindParam(1, $_GET['idPalestrante']); 
                            $stmt->bindParam(2, $_GET['idCurso']); 
                            $stmt->bindParam(3, $_POST['sala']); 
                            $stmt->execute();				
                            Log::getInstance()->inserir(LOCAL_DP,"INSERT na tabela `palestrantecurso` executada...");
                            $okay = true;
                            echo"<script>
                            alert('Palestrante Matriculado com sucesso!');
                            window.location.href='../palestrante_crud';
                            </script>";	
                          
                        }catch (Exception $e) {
                        
                            Log::getInstance()->inserir(LOCAL_DP,"Erro - " . $e->getCode() . " - " . $e->getMessage());
                            $code =  $e->getCode();
                            $message =  $e->getMessage();
                            $okay = false;
                            echo"<script>
                            alert('Erro - $code - $message!');
                            window.location.href='../palestrante_crud';
                            </script>";
                       }
                       if($okay==false){
                        header('Location: ../palestrante_crud');
                      }
                    }

?>