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
                    <input type="button" value="Pesquisar" onclick="xajax_menuProfessor('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio"> Pesquisar apenas alunos matriculados
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" checked> Pesquisar apenas alunos não matriculado
                </td>
            </tr>
            <tr>
                <td><input type="button" value="Novo" onclick="xajax_menuProfessor('novo')"></td>
                <td><input type="button" value="Limpar" onclick="xajax_menuProfessor('pesquisa')"></td>
            </tr>
        </table>
        </form>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $professor = new Professor();
        $professores = $professor->retornaProfessores($form['radio'], $form['pesq_aluno']);

        $html = '';
        foreach ($professores as $p) {
            $html .= '<form class="centralizado" id="' . formIdProfessor . $p['id'] . '" name="' . formIdProfessor . $p['id'] . '" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $p['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $p['nome'] . '">
                        <input readonly type="button" value="Editar" onclick="xajax_menuProfessor(\'editar\',xajax.getFormValues(' . formIdProfessor . $p['id'] . '))">
                        <input readonly type="button" value="Apagar" onclick="xajax_apagarProfessor(xajax.getFormValues(' . formIdProfessor . $p['id'] . '))">
                      </form>';
        }


        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $professor = new Professor();
        $matricula = $form['matricula'];
        $professor->setMatricula($matricula);
        $a = $professor->retornaProfessor();


        $html = <<<HTML
            <form id="formProfessor" name="formProfessor" method="post">
                <table>
                    <tr>
                        <td class="direita">Matricula</td>
                        <td>
                            <input type="text" required name="matricula" size="4" value="{$a[0]['id']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50" value="{$a[0]['nome']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Email</td>
                        <td><input type="email" required name="email" size="50" value="{$a[0]['email']}"></td>
                    </tr>
                    <tr>
                        <td class="direita">Endereço</td>
                        <td><input type="text" required name="endereco" size="50" value="{$a[0]['endereco']}"></td>
                    </tr>
                    <tr>
                        <td class="direita">Telefone</td>
                        <td><input type="text" required name="telefone" onkeypress="mascara(this, '## #####-####')" maxlength="13" value="{$a[0]['telefone']}"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_atualizarProfessor(xajax.getFormValues('formProfessor'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = '<form id="formProfessor" name="formProfessor" method="post">
                <table border="1">
                    <tr>
                        <td class="direita">Nome</td>
                        <td colspan="2">
                            <input type="text" required name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Email</td>
                        <td colspan="2"><input type="email" required name="email" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Endereço</td>
                        <td colspan="2"><input type="text" required name="endereco" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Telefone</td>
                        <td colspan="2"><input type="text" required name="telefone" onkeypress="mascara(this, \'## #####-####\')" maxlength="13"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><input type="button" value="Salvar" onclick="xajax_salvarProfessor(xajax.getFormValues(\'formProfessor\'))"></td>
                    </tr>
                    <tr>
                        <th colspan="3">Disciplinas</th>
                    </tr>';
        $disciplinas = new Disciplina();
        
        foreach ($disciplinas->retornaTodasDisciplinas() as $disciplina) {

            $html .= "<tr>
                                <td>{$disciplina['id']}</td>
                                <td>{$disciplina['nome']}</td>
                                <td><input class=\"centralizado\" type='checkbox' name=\"disciplinas[]\" value=" . $disciplina['id'] . "></td>
                      </tr>";
        }

        $html .= '</table>
           </form>';

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}

// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario