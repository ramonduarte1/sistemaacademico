<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    <fieldset>
//        <legend>Select a maintenance drone</legend>
//echo 'checkbox: ' . $_POST['checkbox'];
require_once '../autoload.php';

$pesquisa = $_POST['pesq_aluno'];

if ($_POST['checkbox'] == 1) {//matriculados
    $sql = "select *from aluno inner join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where aluno.nome like '$pesquisa%'";
} else {//nao matriculado
    $sql = "select *from aluno left join aluno_disciplina on (aluno.id = aluno_disciplina.aluno_id) where aluno_disciplina.aluno_id is null and aluno.nome like '$pesquisa%'";
}

$conexao = new Conexao();
$alunos = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (count($alunos) < 1) {
    echo "<script>alert('Nenhum registro encontrado!')</script> ";
} else {

    foreach ($alunos as $aluno) {
        echo "  <form action='../controller/AlunoController.php' method='post'>
                <table>
                   <tr>
                       <th>Matricula</th>
                       <th>Nome</th>
                       <th>Email</th>
                       <th>Endereço</th>
                       <th>Telefone</th>
                   </tr>
                   <tr>
                       <td><input size='4' readonly name='matricula' value='" . $aluno['id'] . "'></td>
                       <td><input required name='nome' type='text' value='" . $aluno['nome'] . "'></td>
                       <td><input required name='email' type='text' value='" . $aluno['email'] . "'></td>
                       <td><input required name='endereco' type='text' value='" . $aluno['endereco'] . "'></td>
                       <td><input required name='telefone' onkeypress=\"mascara(this, '## #####-####')\" maxlength=\"13\" type='text' value='" . $aluno['telefone'] . "' ></td>
                       <input type='hidden' name='atualizar' value='atualizar'>                       
                       <td><button>salvar</button></td>
                       </form>
                       <td>
                           <form action='../controller/AlunoController.php' method='post'>
                              <input name='matricula' type='hidden' value='" . $aluno['id'] . "'>
                              <input name='apagar' type='hidden' value='apagar'>
                              <button>apagar</button></td>
                           </form>
                       </td>
                   </tr>
                </table>";
    }
}