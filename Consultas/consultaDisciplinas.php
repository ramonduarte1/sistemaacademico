<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../autoload.php';

$pesquisa = $_POST['pesq_disciplina'];

$sql = "select *from disciplina where nome like '$pesquisa%' and deletado <> 's'";

$conexao = new Conexao();

$disciplinas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

foreach ($disciplinas as $disciplina) {
    echo "
           <form action='../controller/DisciplinaController.php' method='post'>
           <table>
              <tr>
                  <th>Matricula</th>
                  <th>Nome</th>
                  <th>Carga Horaria</th>
              </tr>
              <tr>
                   <td><input size='4' readonly name='matricula' value='" . $disciplina['id'] . "'></td>
                   <td><input required name='nome' type='text' value='" . $disciplina['nome'] . "'></td>
                   <td><input required name='carga_horaria' type='text' value='" . $disciplina['carga_horaria'] . "'></td>
                   <input name='atualizar' type='hidden' value='atualizar'>
                   <td><button>salvar</button></td>
           </form>
                  <td>
                   <form action='../controller/DisciplinaController.php' method='post'>
                      <input name='matricula' type='hidden' value='" . $disciplina['id'] . "'>
                      <input name='apagar' type='hidden' value='apagar'>
                      <button>apagar</button>
                   </form>
                  </td>
              </tr>
           </table>";
}
