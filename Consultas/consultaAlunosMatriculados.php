<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    <fieldset>
//        <legend>Select a maintenance drone</legend>

session_start();

foreach ($_SESSION['alunos_matriculados'] as $matricula => $aluno) {

    $pesquisa = $_POST['pesq_aluno'];

    $pattern = '/' . $pesquisa . '/'; //Padrão a ser encontrado na string $tags
    if (preg_match($pattern, $aluno['aluno']['nome'])) {
        echo "
                   <form action='../controller/IncluirNotasController.php' method='post'>
                    <table border='1'>
                       <tr>
                       <td colspan='7'>Aluno</td>
                       </tr>
                       <tr>
                           <th>Matricula</th>
                           <th>Nome</th>
                           <th colspan='2'>Email</th>
                           <th colspan='2'>Endereço</th>
                           <th>Telefone</th>
                       </tr>
                       <tr>
                           <td>$matricula</td>
                           <td>".$aluno['aluno']['nome']."</td>
                           <td colspan='2'>" . $aluno['aluno']['email'] . "</td>
                           <td colspan='2'>" . $aluno['aluno']['endereco'] . "</td>
                           <td>" . $aluno['aluno']['telefone'] . "</td>
                       </tr>
                       <tr>
                           <td colspan='7'>Disciplinas</td>
                       </tr>
                       <tr>
                            <th>Codigo</th>
                            <th colspan='3'>Nome</th>
                            <th>Nota 1</th>
                            <th>Nota 2</th>
                            <th>Nota 3</th>
                       </tr>";
                       
                       foreach ($aluno['disciplina'] as $codigo => $nome):
                        $_SESSION['codigos'][$codigo] = $codigo;
                       echo "<tr>
                                <td><input size='3' readonly name='codigo' value='$codigo'></td>
                                <td colspan='3'>$nome</td>
                                <td><input size='2' type='number' step=\"0.01\" min=\"0.0\" max=\"10.0\" name='n1_$codigo' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n1']."'></td>
                                <td><input size='2' type='number' step=\"0.01\" min=\"0\" max=\"10\" name='n2_$codigo' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n2']."'></td>
                                <td><input size='2'type='number' step=\"0.01\" min=\"0\" max=\"10\" name='n3_$codigo' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n3']."'></td>
                            </tr>";
                       endforeach;
                    echo "<tr>
                             <th colspan='7'>Turmas</th>
                          </tr>
                          <tr>
                             <th>Codigo</th>
                             <th colspan='6'>Nome</th>
                          </tr>";
                        foreach ($aluno['turma'] as $codigo => $nome):
                            echo "<td>$codigo</td>
                                  <td colspan='6'>$nome</td>";
                        endforeach;
                        
                        echo "<tr>
                            <td colspan='6'></td>
                            <td>
                               <input type='hidden' name='matricula' value='" . $matricula . "'>
                               <button>salvar</button>
                            </td>
                              </tr>
                             </table></form>";
   }
}