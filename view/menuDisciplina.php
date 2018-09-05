<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuDisciplina($tipo, $form) {
    $obj_response = new xajaxResponse();
//, xajax.getFormValues('formPesquisa')
    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Disciplina</h2><br><br>
        <table border="0">
            <tr>
                <td colspan="3">
                <form id="formPesquisa" name="formPesquisa">
                    <input required="" type="text" size="50" id="pesq_disciplina" name="pesq_disciplina">
                </form>
                </td>
                <td>
                     <input type="button" value="Pesquisar" onclick="xajax_menuDisciplina('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <tr>
                <td rowspan="2">Filtros</td>
                <td>
                    <input type="radio" id="radio" value="1" name="radio" checked> Nome
                </td>
                <td>
                    <input type="radio" id="radio" value="2" name="radio"> Matricula
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="radio" value="3" name="radio" >Professor
                </td>
                <td>
                    <input type="radio" id="radio" value="4" name="radio" >Aluno
                </td>
            </tr>
                <tr>
                <td></td>
                <td class="centralizado"><input type="button" value="Novo" onclick="xajax_menuDisciplina('novo')"></td>
                <td class="centralizado"><input type="button" value="Limpar" onclick="xajax_menuDisciplina('pesquisa')"></td>
            </tr>
        </table>
        <hr/>
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $disciplina = new Disciplina();
        $disciplinas = $disciplina->retornaDisciplinas($form['radio'], $form['pesq_disciplina']);

        $html = '';
        foreach ($disciplinas as $d) {
            $html .= '<form class="centralizado" id="' . formIdDisciplina . $d['id'] . '" name="' . formIdDisciplina . $d['id'] . '" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $d['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $d['nome'] . '">
                        <input type="button" value="Editar" onclick="xajax_menuDisciplina(\'editar\',xajax.getFormValues(' . formIdDisciplina . $d['id'] . '))">
                        <input type="button" value="Apagar" onclick="xajax_apagarDisciplina(xajax.getFormValues(' . formIdDisciplina . $d['id'] . '))">
                      </form>';
        }


        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $disciplina = new Disciplina();
        $matricula = $form['matricula'];
        $disciplina->setCodigo($matricula);
        $d = $disciplina->retornaDisciplina();
        $a = 1;

        $html = <<<HTML
            <form id="formDisciplina" name="formDisciplina" method="post">
                <table>
                    <tr>
                        <td class="direita">Codigo</td>
                        <td>
                            <input type="text" required name="matricula" size="4" value="{$d[0]['id']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50" value="{$d[0]['nome']}">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Carga Horaria</td>
                        <td><input type="text" required name="carga_horaria" size="50" value="{$d[0]['carga_horaria']}"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_atualizarDisciplina(xajax.getFormValues('formDisciplina'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = <<<HTML
            <form id="formDisciplina" name="formDisciplina" method="post">
                <table>
                    <tr>
                        <td class="direita">Nome*</td>
                        <td>
                            <input type="text" required id="nome" name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Carga Horaria*</td>
                        <td><input type="text" required id="carga_horario" name="carga_horaria" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Ementa</td>
                        <td><input type="file" name="file" id="file" size="50"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_salvarDisciplina(xajax.getFormValues('formDisciplina'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}
// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario