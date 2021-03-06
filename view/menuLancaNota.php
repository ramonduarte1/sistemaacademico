<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuLancaNota($tipo, $form) {
    $obj_response = new xajaxResponse();

    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Incluir Notas</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
            <table border="0">
                <tr>
                    <th>Pesquisa</th>
                    <td>
                        <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                    </td>
                    <td>
                        <input type="button" class="button" value="Pesquisar" onclick="xajax_menuLancaNota('filtrar', xajax.getFormValues('formPesquisa'))">
                    </td>
                </tr>
               <table border='0'>
                <tr>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="1" name="radio" checked>Nome
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="2" name="radio" >Matricula
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="3" name="radio">Turma
                    </td>
                </tr>
               </table>
            </table>
        </form>
        <hr/>
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $aluno = new Aluno();
        $alunos = $aluno->pesqMenuMatricula($form);

        $html = '';
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $a['id'] . ' " size="2">
                        <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                        <input readonly type="button"  class="button" value="Incluir Notas" onclick="xajax_menuLancaNota(\'incluir_notas\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                        <input readonly type="button"  class="button" value="Imprimir Boletinho" onclick="xajax_menuLancaNota(\'incluir_notas\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                      </form>';
        }
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'incluir_notas') {
        $aluno = new Aluno();
        $aluno->setMatricula($form['matricula']);
        $a = $aluno->retornaAluno();

        $html = "<form id=\"formIncluirNotas\" name=\"formIncluirNotas\" method=\"post\">
                 <table class='centralizado' border=\"1\">
                   <tr>
                       <th BGCOLOR=\"#e8e8e8\" colspan=\"8\">Aluno</th>
                   </tr>
                   <tr>
                        <th>Matricula</th>
                        <th>Nome</th>
                        <th colspan =\"2\">Email</th>
                        <th colspan=\"3\">Endereco</th>
                        <th>Telefone</th>
                   </tr>
                   <tr>
                        <td>" . $a[0]['id'] . "</td>
                            <input type=\"hidden\" id=\"aluno_id\" name=\"aluno_id\" value=" . $a[0]['id'] . ">
                        <td>" . $a[0]['nome'] . "</td>
                        <td colspan='2'>" . $a[0]['email'] . "</td>
                        <td colspan='3'>" . $a[0]['endereco'] . "</td>
                        <td>" . $a[0]['telefone'] . "</td>
                   </tr>
                   <tr>
                        <th BGCOLOR=\"#e8e8e8\" colspan=\"8\" >Disciplinas</th>
                   </tr>
                   <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>C.Horária</th>
                        <th>Nota 1</th>
                        <th>Nota 2</th>
                        <th>Nota 3</th>
                        <th>Media</th>
                        <th>Situação</th>
                   </tr>";
        $disciplinas = new AlunoDisciplina();
        $disciplinas->setAluno_id($form['matricula']);

        foreach ($disciplinas->retornaNotas() as $d) {

            $html .= "<tr>
                        <td>" . $d['disciplina_id'] . "</td>
                        <input type=\"hidden\" id=\"disciplinas[]\" name=\"disciplinas[]\" value=" . $d['id'] . ">
                        <td>" . $d['nome'] . "</td>
                        <td>" . $d['carga_horaria'] . "</td>
                        <td><input class=\"semborda\" onkeyup=\"mascara( this, intervalo );\" id=" . $d['disciplina_id'] . n1 . " name=" . $d['disciplina_id'] . n1 . " value=" . $d['nota1'] . " size='3'></td>
                        <td><input class=\"semborda\" onkeyup=\"mascara( this, intervalo );\" id=" . $d['disciplina_id'] . n2 . " name=" . $d['disciplina_id'] . n2 . " value=" . $d['nota2'] . " size='3' ></td>
                        <td><input class=\"semborda\" onkeyup=\"mascara( this, intervalo );\" id=" . $d['disciplina_id'] . n3 . " name=" . $d['disciplina_id'] . n3 . " value=" . $d['nota3'] . " size='3' ></td>
                        <td><input class=\"semborda\" readonly  size='5' value=" . $d['media'] . "></td>
                        <td><input class=\"semborda\" readonly  size='10' value=" . $d['situacao'] . "></td>
                     </tr>";
        }
        $turma = new Turma();
        $turma->setCodigo($a[0]['turma_id']);
        $t = $turma->retornaTurma();

        $html .= "<tr>
                     <th  BGCOLOR=\"#e8e8e8\" colspan = '8'>Turma</th>
                  </tr>
                  <tr>
                      <th>Codigo</th>
                      <td>" . $a[0]['turma_id'] . "</td>
                      <th>Nome</th>
                      <td colspan = '6'>" . $t[0]['nome'] . "</td>
                  </tr>
                  <tr>
                      <td colspan = '6'></td>
                      <td>
                        <input value='Imprimir' type='button' class='button' onclick=\"imprimeBoletinho()\">
                      </td> 
                      <td>
                          <input value='Salvar' type='button' class='button'  onclick =\"xajax_salvaNotas(xajax.getFormValues('formIncluirNotas'))\">
                      </td>    
                 </tr>";

        $html .= "<table>
                  </form>";
        $obj_response->assign("retorno", "innerHTML", $html);
    }
    return $obj_response;
}

// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario