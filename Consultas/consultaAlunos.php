<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//    <fieldset>
//        <legend>Select a maintenance drone</legend>


session_start();
foreach ($_SESSION['alunos'] as $matricula => $aluno) {
    
          $pesquisa = $_POST['pesq_aluno'];

          $pattern = '/' . $pesquisa . '/';//Padrão a ser encontrado na string $tags
          if (preg_match($pattern, $aluno['nome'])) {
             echo "<form action='../controller/AlunoController.php' method='post'>
                            <input size='4' readonly name='matricula' value='".$matricula."'>
                            <input name='nome' type='text' value='".$aluno['nome']."'>
                            <input name='email' type='text' value='".$aluno['email']."'>
                            <input name='endereco' type='text' value='".$aluno['endereco']."'>
                            <input name='telefone' type='text' value='".$aluno['telefone']."'>
                            <button>salvar</button>
                    </form>";
          
          }
    
}
