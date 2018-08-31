<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/css.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if ((!isset($_SESSION['login']) == true) and ( !isset($_SESSION['senha']) == true)) {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            echo "<script>alert('Area restrita!');location.href=\"../index.php\"</script> ";
        }
        $logado = $_SESSION['login'];

        require_once '../autoload.php';


        $sql = "select *from disciplina where deletado = 'n'";

        $conexao = new Conexao();

        $disciplinas = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($disciplinas);

        include 'menu.php';
        ?>
        <h2 class="centralizado">Cadastro Turma</h2><br><br>
        <form action="../controller/TurmaController.php" method="post">
            <table>
<!--                <tr>
                    <td class="direita">Matricula</td>
                    <td><input readonly="" name="matricula" value="<?php echo $_SESSION['matricula'] ?>" size="4"></td>
            </tr>-->
                <tr>
                    <td class="direita">Nome</td>
                    <td>
                        <input type="text" required name="nome" size="50">
                    </td>
                </tr>
                <tr >
                    <td>Turno</td>
                    <td>
                        <select name="turno">
                            <option value="manha">Manhã</option>
                            <option value="tarde">Tarde</option>
                            <option value="noite">Noite</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button>salvar</button>
                    </td>
                </tr>
            </table>

            <?php
            if (count($disciplinas) < 1) {
                echo 'Nenhuma Disciplina Cadastrada!';
            } else {
                ?>

                <form action='../controller/DisciplinaController.php' method='post'>
                    <table>
                        <tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th>Carga Horaria</th>
                            <th></th>
                        </tr>
                        <?php foreach ($disciplinas as $disciplina) {
                            ?>


                            <tr>
                                <td><input size='4' readonly name='matricula' value="<?php echo $disciplina['id'] ?> "></td>
                                <td><input required name='nome' type='text' value="<?php echo $disciplina['nome'] ?> "></td>
                                <td><input required name='carga_horaria' type='text' value="<?php echo $disciplina['carga_horaria'] ?> "></td>
                                <td><input type='checkbox' ></td>
                                </form>
                            </tr>

                        <?php }
                        ?>
                    </table>

                </form>
            <?php }
            ?>
    </body>
</html>
