<?php

require_once '../autoload.php';

$pesquisa = $_POST['pesq_professor'];

$sql = "select *from professor where nome like '$pesquisa%' and deletado <> 's'";

$conexao = new Conexao();

$professores = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);

if (count($professores) < 1) {
    echo "<script>alert('Nenhum registro encontrado!')</script> ";
} else {
    foreach ($professores as $professor) {
        echo "
                    <form action='../controller/ProfessorController.php' method='post'>
                    <table>
                       <tr>
                           <th>Matricula</th>
                           <th>Nome</th>
                           <th>Email</th>
                           <th>Endereço</th>
                           <th>Telefone</th>
                       </tr>
                       <tr>
                           <td><input required size='4' readonly name='matricula' value='" . $professor['id'] . "'></td>
                           <td><input required name='nome' type='text' value='" . $professor['nome'] . "'></td>
                           <td><input required name='email' type='text' value='" . $professor['email'] . "'></td>
                           <td><input required name='endereco' type='text' value='" . $professor['endereco'] . "'></td>
                           <td><input required name='telefone' onkeypress=\"mascara(this, '## #####-####')\" maxlength=\"13\" type='text' value='" . $professor['telefone'] . "'></td>
                           <input name='atualizar' type='hidden' value='atualizar'>
                           <td><button>salvar</button></td>
                           </form>
                           <td>
                               <form action='../controller/ProfessorController.php' method='post'>
                                  <input name='matricula' type='hidden' value='" . $professor['id'] . "'>
                                  <input name='apagar' type='hidden' value='apagar'>
                                  <button>apagar</button></td>
                               </form>
                           </td>
                       </tr>
                    </table>";
    }
}