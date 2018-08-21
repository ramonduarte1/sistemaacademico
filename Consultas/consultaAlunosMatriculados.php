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
                       
                       echo "<tr>
                                <td>$codigo</td>
                                <td colspan='3'>$nome</td>
                                <td><input size='2' type='text' name='n1' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n1']."'></td>
                                <td><input size='2' type='text' name='n2' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n2']."'></td>
                                <td><input size='2'type='text' name='n3'value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n3']."'></td>
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
/*    if (preg_match($pattern, $aluno['aluno']['nome'])) {

        echo "<h2 class='centralizado'>Aluno</h2><br>"
        . "Matricula<input size='2' value='" . $matricula . "'>Nome:<input value='" . $aluno['aluno']['nome'] . "'>"
        . "Email<input value='" . $aluno['aluno']['email'] . "'><br><br>Endereco<input value='" . $aluno['aluno']['endereco'] . "'>"
        . "Telefone<input value='" . $aluno['aluno']['telefone'] . "'><br>"
        . "<br><h2 class='centralizado'>Disciplinas</h2><br>";

        foreach ($aluno['disciplina'] as $codigo => $nome) {
            echo "<form action='../controller/IncluirNotasController.php' method='post'>"
            . "Codigo<input size='2' name='codigo' value='" . $codigo . "'>Nome<input value='" . $nome . "'>"
            . "nota 1<input size='2' type='text' name='n1' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n1']."'>"//pega as notas da sessao aluno_nota
            . "nota 2<input size='2' type='text' name='n2' value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n2']."'>"
            . "nota 3<input size='2'type='text' name='n3'value='".$_SESSION['aluno_nota'][$matricula][$codigo]['n3']."'>"
            . "<input type='hidden' name='matricula' value='" . $matricula . "'>"
            . "&ensp;<button>salvar</button>"
            . "</form><br><br>";
        }

        echo "<br><h2 class='centralizado'>Turmas</h2><br>";

        foreach ($aluno['turma'] as $codigo => $nome) {
            echo "Codigo<input size='2' value='" . $codigo . "'>Nome<input value='" . $nome . "'>";
        }
    }*/