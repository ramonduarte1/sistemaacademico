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
                        <input type="radio" id="radio" value="1" name="radio" checked> Aluno por nome
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="2" name="radio" > Aluno por matricula
                    </td>
                </tr>
                <tr>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="3" name="radio"> Não matriculado por nome
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="4" name="radio" > Não matriculado por matricula
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="5" name="radio" > Matricula trancada por nome
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

        $html = '<div id="" style="overflow:scroll; height:350px;">';//scroll
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="'.formIdAluno.$a['id'] .'" name="'.formIdAluno.$a['id'] .'" action="" method="post">
                            <input readonly id="matricula" name="matricula" value="'.$a['id'].'" size="4">
                            <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                            <input readonly type="button" class="button" value="Editar" onclick="xajax_menuAluno(\'editar\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                            <input readonly type="button" class="button" value="Apagar"  onclick="confirmacao(\''.apagar_aluno. $a['id'].'\');">
                            <input type="hidden" id="'.'apagar_aluno' . $a['id'].'" name="'.'apagar_aluno' . $a['id'].'"  onclick="xajax_apagarAluno(xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                       </form>';
        }
        $html .=' </div>';
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $aluno = new Aluno();
        $matricula = $form['matricula'];
        $aluno->setMatricula($matricula);
        $a = $aluno->retornaAluno();
        
        $html = '<form id="formAluno" name="formAluno" method="post">
                <table>
                    <tr>
                        <td class="direita">Matricula</td>
                        <td>
                            <input type="text" required name="matricula" size="4" value="' . $a[0]['id'] . '">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" id="nome" size="50" value="' . $a[0]['nome'] . '">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Email</td>
                        <td><input type="email" required name="email" id="email" size="50" value="' . $a[0]['email'] . '"></td>
                    </tr>
                    <tr>
                        <td class="direita">Endereço</td>
                        <td><input type="text" required name="endereco" id="endereco" size="50" value="' . $a[0]['endereco'] . '"></td>
                    </tr>
                    <tr>
                        <td class="direita">Telefone</td>
                        <td><input type="text" required name="telefone" id="telefone" onkeyup="mascara( this, mtel );" maxlength="15" value="' . $a[0]['telefone'] . '"></td>
                    </tr>
                    <tr>
                        <td class="direita">Turma</td>
                        <td><input type="text" readonly name="turma_id" id="turma_id" value="'.$a[0]['turma_id'].' - '.$a[0]['nome_turma'].'" size="50"></td>
                    </tr>';
        if ($a[0]['situacao'] == 'trancado') {
            $html .= '
                    <tr>
                        <td class="direita"><input type="checkbox" checked name="trancar" value="trancado"></td>
                        <td>Trancar Matricula?</td>
                    </tr>';
        } else {
            $html .= '
                    <tr>
                        <td class="direita"><input type="checkbox" name="trancar" value="trancado"></td>
                        <td>Trancar Matricula?</td>
                    </tr>';
        }
        $html .= '  <tr>
                        <td></td>
                        <td><input type="button" class="button" value="Salvar" onclick="xajax_atualizarAluno(xajax.getFormValues(\'formAluno\'))"></td>
                    </tr>
                </table>
           </form>';
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
    return $obj_response;
}
