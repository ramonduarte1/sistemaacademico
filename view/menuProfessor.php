<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuProfessor($tipo, $form) {
    $obj_response = new xajaxResponse();
//, xajax.getFormValues('formPesquisa')
    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Professor</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
        <table border="0">
            <tr>
                <th>Pesquisa</th>
                <td>
                    <input required="" type="text" size="50" id="pesq_professor" name="pesq_professor">
                </td>
                <td>
                    <input type="button" class="button" value="Pesquisar" onclick="xajax_menuProfessor('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio" checked> Pesquisar por nome
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" > Pesquisar por matricula
                </td>
            </tr>
        </table>
            <hr />
                <div class='centralizado'>
                    <input type="button" class="button" value="Novo" onclick="xajax_menuProfessor('novo')">
                    <input type="button" class="button" value="Limpar" onclick="xajax_menuProfessor('pesquisa')">
                </div>
        </form>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $professor = new Professor();
        $professores = $professor->retornaProfessores($form['radio'], $form['pesq_professor']);

        $html = '';
        foreach ($professores as $p) {
            $html .= '<form class="centralizado" id="' . formIdProfessor . $p['id'] . '" name="' . formIdProfessor . $p['id'] . '" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $p['id'] . '" size="4">
                        <input readonly id="nome" name="nome" value="' . $p['nome'] . '">
                        <input readonly type="button" class="button" value="Editar" onclick="xajax_menuProfessor(\'editar\',xajax.getFormValues(' . formIdProfessor . $p['id'] . '))">
                        <input readonly type="button" class="button" value="Apagar"  onclick="confirmacao(\'' . apagar_professor . $p['id'] . '\');">
                        <input type="hidden" id="' . 'apagar_professor' . $p['id'] . '" name="' . 'apagar_professor' . $p['id'] . '" onclick="xajax_apagarProfessor(xajax.getFormValues(' . formIdProfessor . $p['id'] . '))">
                      </form>';
        }


        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $professor = new Professor();
        $matricula = $form['matricula'];
        $professor->setMatricula($matricula);
        $a = $professor->retornaProfessor();

        $d = new Disciplina();
        $disciplinas = $d->retornaTodasDisciplinas();
        $matriculadas = $d->retornaDisciplinasPorProfessor($form['matricula']);


        $html = '<form id="formProfessor" name="formProfessor" method="post">
                <table border="1" class="semborda">
                    <tr>
                        <td class="semborda">Matricula</td>
                        <td class="semborda">
                            <input type="text" required name="matricula" size="4" value=' . $a[0]['id'] . '>
                        </td>
                    </tr>
                    <tr>
                        <td class="semborda">Nome</td>
                        <td class="semborda"> 
                            <input type="text" required name="nome" size="50" value=' . $a[0]['nome'] . '>
                        </td>
                    </tr>
                    <tr>
                        <td class="semborda">Email</td>
                        <td class="semborda"><input type="email" required name="email" size="50" value=' . $a[0]['email'] . '></td>
                    </tr>
                    <tr>
                        <td class="semborda">Endereço</td>
                        <td class="semborda"><input type="text" required name="endereco" size="50" value=' . $a[0]['endereco'] . '></td>
                    </tr>
                    <tr>
                        <td class="semborda">Telefone</td>
                        <td class="semborda"><input type="text" required name="telefone" onkeyup="mascara( this, mtel );" maxlength="15" value="' . $a[0]['telefone'] . '"></td>
                    </tr>
                    <tr>
                        <td class="semborda"></td>
                        <td class="semborda"><input type="button" class="button" value="Salvar" onclick="xajax_atualizarProfessor(xajax.getFormValues(\'formProfessor\'))"></td>
                    </tr>
                    <tr>
                        <th colspan="3">Disciplinas</th>
                    </tr>';
        foreach ($disciplinas as $disciplina) {

            $html .= " <tr>
                            <td class=\"centralizado\">{$disciplina['id']}</td>
                            <td>{$disciplina['nome']}</td>";

            if (in_array($disciplina['id'], array_column($matriculadas, 'disciplina_id'))) { //verifica se essa disciplina estar matriculada nessa turma
                $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . " checked></td>"; //se true deixa marcado
            } else {
                $html .= "<td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td>";
            }
        }


        $html .= "</tr></table>";

        $html .= '</table>
               </form><br><br>';

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = '<form id="formProfessor" name="formProfessor" method="post">
                 <table border="1" class="semborda">
                    <tr>
                        <td class="semborda">Nome</td>
                        <td colspan="2" class="semborda">
                            <input type="text" required name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="semborda">Email</td>
                        <td colspan="2" class="semborda"><input type="email" required name="email" size="50"></td>
                    </tr>
                    <tr>
                        <td class="semborda">Endereço</td>
                        <td colspan="2" class="semborda"><input type="text" required name="endereco" size="50"></td>
                    </tr>
                    <tr>
                        <td class="semborda">Telefone</td>
                        <td colspan="2" class="semborda"><input type="text" required name="telefone" onkeyup="mascara( this, mtel );" maxlength="15"></td>
                    </tr>
                    <tr>
                        <td class="semborda"></td>
                        <td class="semborda"><input type="button" class="button" value="Salvar" onclick="return validarProfessor()"></td>
                        <input type="hidden" id="salvar_professor" name="salvar_professor" onclick="xajax_salvarProfessor(xajax.getFormValues(\'formProfessor\'))">
                    </tr>
                    <tr>
                        <th colspan="3">Disciplinas</th>
                    </tr>';
        $disciplinas = new Disciplina();

        foreach ($disciplinas->retornaTodasDisciplinas() as $disciplina) {

            $html .= "<tr>
                         <td class=\"centralizado\">{$disciplina['id']}</td>
                         <td>{$disciplina['nome']}</td>
                         <td class=\"centralizado\"><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td>
                      </tr>";
        }

        $html .= '</table>
           </form><br><br>';

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario