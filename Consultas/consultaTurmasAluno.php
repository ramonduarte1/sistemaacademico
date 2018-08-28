<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
//foreach ($_SESSION['turmas'] as $matricula => $turma) {

$codigoTurma = $_POST['codigo_turma'];
// echo "codigo da turma post: " . $codigoTurma;
$pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
if (preg_match($pattern, $turma['nome'])) {
    if (isset($_SESSION['alunos_matriculados'])) {
        $flag = 0;
        echo 
         "<table border='1'>
             <tr>
                 <th colspan='2'>Turma</th>
             </tr>
             <tr>
                 <th>Matricula</th>
                 <th>Nome</th>
             </tr>";
        foreach ($_SESSION['alunos_matriculados'] as $matAluno => $value) {

            foreach ($_SESSION['alunos_matriculados'][$matAluno]['turma'] as $codigo => $turma) {

                if ($codigo == $codigoTurma) {
                    $flag++;
                    echo "<tr>
                            <td>$matAluno</td>
                            <td>".$_SESSION['alunos'][$matAluno]['nome']."</td>
                          </tr>";




                }
            }
        }
        echo "<tr>
                 <td>Total</td>
                 <td>$flag</td>
              </tr>
              </table>";
        if ($flag == 0) { // se nao entrou no if flag continua 0
//                
            echo "<script>alert('Nenhum registro encontrado!');;location.href=\"../view/consulta_turma_aluno.php\"</script> ";
        }
    }
}
//}
//ok