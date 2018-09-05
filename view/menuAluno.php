<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuAluno($tipo, $form) {
    $obj_response = new xajaxResponse();
//, xajax.getFormValues('formPesquisa')
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
                    <input type="button" value="Pesquisar" onclick="xajax_menuAluno('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
           <table border='0'>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio"> Matriculado por nome
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" > Matriculado por matricula
                </td>
            </tr>
            <tr>
                <td class="esquerda">
                    <input type="radio" id="radio" value="3" name="radio" checked> Não matriculado por nome
                </td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="4" name="radio" > Não matriculado por matricula
                </td>
            </tr>
           </table>
        </table>
                <hr />
                <div class='centralizado'>
                     <input  type="button" value="Novo" onclick="xajax_menuAluno('novo')">
                     <input  type="button" value="Limpar" onclick="xajax_menuAluno('pesquisa')">
                </div>
                
            </tr>
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
        $a = 1;
        $html = '';
        foreach ($alunos as $a) {
            $html .= '<form class="centralizado" id="' . formIdAluno . $a['id'] . '" name="formIdAluno" action="" method="post">
                        <input readonly id="matricula" name="matricula" value="' . $a['id'] . ' " size="4">
                        <input readonly id="nome" name="nome" value="' . $a['nome'] . '">
                        <input readonly type="button" value="Editar" onclick="xajax_menuAluno(\'editar\',xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                        <input readonly type="button" value="Apagar" onclick="xajax_apagarAluno(xajax.getFormValues(' . formIdAluno . $a['id'] . '))">
                      </form>';
        }


        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'editar') {
        $aluno = new Aluno();
        $matricula = $form['matricula'];
        $aluno->setMatricula($matricula);
        $a = $aluno->retornaAluno();


        $html = <<<HTML
            <form id="formAluno" name="formAluno" method="post">
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
                        <td><input type="button" value="Salvar" onclick="xajax_atualizarAluno(xajax.getFormValues('formAluno'))"></td>
                    </tr>
                </table>
           </form>
HTML;
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
                        <td><input type="text" required name="telefone" onkeypress="mascara(this, '## #####-####')" maxlength="13"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_salvarAluno(xajax.getFormValues('formAluno'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}

// retornar uma listagem dos alunos em grid quando clicar no aluno abre a manutencao do usuario