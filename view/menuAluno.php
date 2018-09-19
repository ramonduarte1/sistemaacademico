<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuAluno($tipo, $form) {
    $obj_response = new xajaxResponse();

    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Aluno</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
        <table border="0">
            <tr>
                <th>Pesquisa</th>
                <td>
                    <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                </td>
                <td>
                    <input type="button" class="button" value="Pesquisar" onclick="xajax_menuAluno('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <table border='0'>
                <tr>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="1" name="radio" checked> Nome
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="2" name="radio" > Matricula
                    </td>
                </tr>
                
            </table>
        </table>
            <hr />
            <div class='centralizado'>
                <input  type="button" class="button" value="Novo" onclick="xajax_menuAluno('novo')">
                <input  type="button" class="button" value="Limpar" onclick="xajax_menuAluno('pesquisa')">
            </div>
        </form>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $aluno = new Aluno();
        $alunos = $aluno->retornaAlunos($form['radio'], $form['pesq_aluno']);

        $html = '<div id="" style="overflow:scroll; height:350px;">'; //scroll
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="' . formIdAluno . $a['id'] . '" action="" method="post">
                                                  
                            <input readonly id="matricula" name="matricula" value="' . $a['id'] . '" size="4">
                            <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                            <input type="button" class="button" value="Editar" onclick="xajax_menuAluno(\'editar\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                            <input type="button" class="button" value="Apagar"  onclick="confirmacao(\'' . apagar_aluno . $a['id'] . '\');">
                            <input type="button" class="button" value="Comprovante"  onclick="xajax_menuAluno(\'comprovante\' ,xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                            <input type="hidden" id="' . 'apagar_aluno' . $a['id'] . '" name="' . 'apagar_aluno' . $a['id'] . '"  onclick="xajax_apagarAluno(xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                       
                       </form>';
        }
        $html .= '</div>';

        $obj_response->assign("retorno", "innerHTML", $html);
        $obj_response->script("favDialog.showModal();");
    }

    if ($tipo == 'editar') {
        $aluno = new Aluno();
        $matricula = $form['matricula'];
        $aluno->setMatricula($matricula);
        $a = $aluno->retornaAluno();

        $d = new Disciplina();
        $disciplinas = $d->retornaDisciplinasPorTurma($a[0]['turma_id']);
        $matriculadas = $d->retornaDisciplinasPorAluno($form['matricula']);
        //scroll
        $html = '<div id="" style="overflow:scroll; height:500px;"> 
                 <form id="formAluno" name="formAluno" method="post">
                    <table border="1" class="semborda">
                    <tr>
                        <td class="semborda">Matricula</td>
                        <td class="semborda">
                            <input type="text" required name="matricula" size="4" value="' . $a[0]['id'] . '">
                        </td>
                    </tr>
                    <tr>
                        <td class="semborda">Nome</td>
                        <td class="semborda">
                            <input type="text" required name="nome" id="nome" size="50" value="' . $a[0]['nome'] . '">
                        </td>
                    </tr>
                    <tr>
                        <td class="semborda">Email</td>
                        <td class="semborda"><input type="email" required name="email" id="email" size="50" value="' . $a[0]['email'] . '"></td>
                    </tr>
                    <tr>
                        <td class="semborda">Endereço</td>
                        <td class="semborda"><input type="text" required name="endereco" id="endereco" size="50" value="' . $a[0]['endereco'] . '"></td>
                    </tr>
                    <tr>
                        <td class="semborda">Telefone</td>
                        <td class="semborda"><input type="text" required name="telefone" id="telefone" onkeyup="mascara( this, mtel );" maxlength="15" value="' . $a[0]['telefone'] . '"></td>
                    </tr>';
        if (count($disciplinas) > 0) {
            $html .= '
                    <tr>
                        <th colspan="3">Turma</th>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th colspan="2">Nome</th>
                    </tr>
                    <tr>
                        <td class="centralizado"> ' . $a[0]['turma_id'] . '</td>
                        <td colspan="2"> ' . $a[0]['nome_turma'] . '</td>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th colspan="2">Disciplina</th> 
                     </tr>';
            foreach ($disciplinas as $disciplina) {
                $html .= " <tr>
                           <td class=\"centralizado\">{$disciplina['id']}</td>
                           <td>{$disciplina['nome']}</td>";
                if (in_array($disciplina['id'], array_column($matriculadas, 'disciplina_id'))) { //verifica se essa disciplina estar matriculada nessa turma
                    $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . " checked></td></tr>"; //se true deixa marcado
                } else {
                    $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td></tr>";
                }
            }
            if ($a[0]['situacao'] == 'trancado') {
                $html .= '
                    <tr>
                        <td></td>
                        <td class="direita">Trancar Matricula?</td>
                        <td><input type="checkbox" checked name="trancar" value="trancado"></td>
                    </tr>';
            } else {
                $html .= '
                    <tr>
                        <td></td>
                        <td class="direita">Trancar Matricula?</td>
                        <td><input type="checkbox" name="trancar" value="trancado"></td>
                    </tr>';
            }
        }
        $html .= ' <tr>';

        if (count($disciplinas) > 0) {
            $html .= '<td class="semborda">
                        <input type="button" class="button" value="Sair da Turma" onclick="confirmacao(\'remover_turma\')">
                        <input type="hidden" id="remover_turma" name="remover_turma" onclick="xajax_removerTurma(xajax.getFormValues(\'formAluno\'))">
                      </td>';
        }
        $html .= '    <td class="semborda"></td>
                      <td colspan="2" class="direita"><input type="button" class="button" value="Salvar" onclick="xajax_atualizarAluno(xajax.getFormValues(\'formAluno\'))"></td>
                   </tr>
            </table>
           </form>
           </div>
           <br><br>';
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = <<<HTML
            <form id="formAluno" name="formAluno" method="post">
                <table>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Email</td>
                        <td><input type="email" required name="email" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Endereço</td>
                        <td><input type="text" required name="endereco" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Telefone</td>
                        <td><input type="text" required id="telefone" name="telefone" onkeyup="mascara( this, mtel );" maxlength="15"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" class="button" value="Salvar" onclick="return validarAluno()"></td>
                        <input type="hidden" id="salvar_aluno" name="salvar_aluno" onclick="xajax_salvarAluno(xajax.getFormValues('formAluno'))">
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }
    if ($tipo == 'comprovante') {
        $aluno = new Aluno();
        $aluno->setMatricula($form['matricula']);
        $a = $aluno->retornaAluno();

        $html = "<form id=\"formIncluirNotas\" name=\"formIncluirNotas\" method=\"post\">
                 <table class='centralizado' border=\"1\">
                   <tr>
                       <th BGCOLOR=\"#e8e8e8\" colspan=\"4\">Aluno</th>
                   </tr>
                   <tr>
                        <th>Matricula</th>
                        <th colspan='2'>Nome</th>
                        <th>Email</th>
                   </tr>
                   <tr>
                        <td>" . $a[0]['id'] . "</td>
                        <input type=\"hidden\" id=\"aluno_id\" name=\"aluno_id\" value=" . $a[0]['id'] . ">
                        <td colspan='2'>" . $a[0]['nome'] . "</td>
                        <td >" . $a[0]['email'] . "</td>
                   </tr>
                   <tr>
                        <th>Endereco</th>
                        <td>" . $a[0]['endereco'] . "</td>
                        <th>Telefone</th>
                        <td>" . $a[0]['telefone'] . "</td>
                   </tr>
                   <tr>
                        <th BGCOLOR=\"#e8e8e8\" colspan=\"4\" >Disciplinas</th>
                   </tr>
                   <tr>
                        <th>Codigo</th>
                        <th colspan='2'>Nome</th>
                        <th>C.Horária</th>
                   </tr>";
        $disciplinas = new AlunoDisciplina();
        $disciplinas->setAluno_id($form['matricula']);

        foreach ($disciplinas->retornaNotas() as $d) {

            $html .= "<tr>
                        <td>" . $d['disciplina_id'] . "</td>
                            <input type=\"hidden\" id=\"disciplinas[]\" name=\"disciplinas[]\" value=" . $d['id'] . ">
                        <td colspan='2'>" . $d['nome'] . "</td>
                        <td>" . $d['carga_horaria'] . "</td>
                     </tr>";
        }
        $turma = new Turma();
        $turma->setCodigo($a[0]['turma_id']);
        $t = $turma->retornaTurma();

        $html .= "<tr>
                     <th  BGCOLOR=\"#e8e8e8\" colspan = '4'>Turma</th>
                  </tr>
                  <tr>
                      <th>Codigo</th>
                      <td>" . $a[0]['turma_id'] . "</td>
                      <th>Nome</th>
                      <td colspan = '3'>" . $t[0]['nome'] . "</td>
                  </tr>
                  <tr>
                      <td colspan = '3'></td>
                      <td>
                          <input type=\"button\" value='Imprimir' class='button' onclick=\"imprimeBoletinho()\">
                      </td>    
                 </tr>";

        $html .= "<table>
                  </form>";
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}
