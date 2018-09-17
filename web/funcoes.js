/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function imprimeBoletinho() {
    var conteudo = document.getElementById('formIncluirNotas').innerHTML,
            tela_impressao = window.open('about:blank');
    tela_impressao.document.write(conteudo);
    tela_impressao.window.print();
    tela_impressao.window.close();
}
function mascara(t, mask) {
    var i = t.value.length;
    var saida = mask.substring(1, 0);
    var texto = mask.substring(i)
    if (texto.substring(0, 1) != saida) {
        t.value += texto.substring(0, 1);
    }
}
//funcao responsavel por perguntar o usuario se realmente quer continuar ele recebe o nome
// de um formulario hidden para ser clicado caso for true a resposta do ussuario
function confirmacao(acao) {
    var retVal = confirm("Deseja continuar ?");
    if (retVal == true) {
        document.getElementById(acao).click(); // pede a confirmacao do usuario se for true passa o campo do input hidden para terminar a rotina
        return true;
    } else {
        return false;
    }
}
function validarAluno() {
    var nome = formAluno.nome.value;
    var email = formAluno.email.value;
    var endereco = formAluno.endereco.value;
    var telefone = formAluno.telefone.value;
    if (nome == "") {
        alert('Preencha o campo com seu nome');
        formAluno.nome.focus();
        return false;
    } else if (email == "" || email.indexOf('@') == -1
            || email.indexOf('.') == -1) {
        alert('Preencha o campo com seu email corretamente');
        formAluno.nome.focus();
        return false;
    } else if (endereco == "") {
        alert('Preencha o campo com seu endereço');
        formAluno.nome.focus();
        return false;
    } else if (telefone == "") {
        alert('Preencha o campo com seu telefone');
        formAluno.nome.focus();
        return false;
    } else {
        document.getElementById("salvar_aluno").click();
    }
}

