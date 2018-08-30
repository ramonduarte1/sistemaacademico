<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../autoload.php';

$pesquisa = $_POST['pesq_turma'];

$sql = "select *from turma where nome like '$pesquisa%' and deletado <> 's'";

$conexao = new Conexao();

$turmas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

foreach ($turmas as $turma) {

    echo "
        <form action='../controller/TurmaController.php' method='post'>
        <table>
           <tr>
               <th>Matricula</th>
               <th>Nome</th>
           </tr>
           <tr>
                 <td><input size='4' readonly name='matricula' value='" . $turma['id'] . "'></td>
                 <td><input required name='nome' type='text' value='" . $turma['nome'] . "'></td>
                 <input name='atualizar' type='hidden' value='atualizar'>
                 <td><button>salvar</button></td>
        </form>
                 <td>
                   <form action='../controller/TurmaController.php' method='post'>
                      <input name='matricula' type='hidden' value='" . $turma['id'] . "'>
                      <input name='apagar' type='hidden' value='apagar'>
                      <button>apagar</button>
                   </form>
                 </td>
           </tr>
        </table>";
}
