<?php
require_once 'funcoes.php';

$ex = $_POST['ex'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atividade 5 - PHP</title>
</head>
<body>

<h1>Atividade 5 - PHP</h1>

<fieldset id="ex01">
    <legend>Exercício 01 - Calculadora da Engenharia</legend>
    <form method="post" action="formulario.php#ex01">
        <input type="hidden" name="ex" value="01">
        x: <input type="text" name="x" value="<?= e($_POST['x'] ?? '') ?>">
        y: <input type="text" name="y" value="<?= e($_POST['y'] ?? '') ?>">
        <button>Calcular</button>
    </form>

    <?php if ($ex === '01'): ?>
        <div class="resultado">
            <?= renderizar(calcularFormula(numero($_POST['x'] ?? 0), numero($_POST['y'] ?? 0))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex02">
    <legend>Exercício 02 - Espelho Mágico</legend>
    <form method="post" action="formulario.php#ex02">
        <input type="hidden" name="ex" value="02">
        Texto: <input type="text" name="texto" value="<?= e($_POST['texto'] ?? '') ?>">
        <button>Inverter</button>
    </form>

    <?php if ($ex === '02'): ?>
        <div class="resultado">
            <?= renderizar(inverterTexto($_POST['texto'] ?? '')) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex03">
    <legend>Exercício 03 - Cadastro Seguro</legend>
    <form method="post" action="formulario.php#ex03">
        <input type="hidden" name="ex" value="03">
        CPF: <input type="text" name="cpf" value="<?= e($_POST['cpf'] ?? '') ?>">
        <button>Mascarar</button>
    </form>

    <?php if ($ex === '03'): ?>
        <div class="resultado">
            <?= renderizar(mascararCpf($_POST['cpf'] ?? '')) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex04">
    <legend>Exercício 04 - Gerador de Senhas</legend>
    <form method="post" action="formulario.php#ex04">
        <input type="hidden" name="ex" value="04">
        Quantidade de caracteres:
        <input type="number" name="tam" min="1" max="128" value="<?= e($_POST['tam'] ?? '') ?>">
        <button>Gerar</button>
    </form>

    <?php if ($ex === '04'): ?>
        <div class="resultado">
            <?= renderizar(gerarSenha((int) ($_POST['tam'] ?? 1))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex05">
    <legend>Exercício 05 - Estatísticas de Texto</legend>
    <form method="post" action="formulario.php#ex05">
        <input type="hidden" name="ex" value="05">
        <textarea name="texto" rows="3"><?= e($_POST['texto'] ?? '') ?></textarea><br>
        <button>Analisar</button>
    </form>

    <?php if ($ex === '05'): ?>
        <div class="resultado">
            <?= renderizar(analisarTexto($_POST['texto'] ?? '')) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex06">
    <legend>Exercício 06 - Conversor de Temperatura</legend>
    <form method="post" action="formulario.php#ex06">
        <input type="hidden" name="ex" value="06">

        Valor:
        <input type="text" name="valor" value="<?= e($_POST['valor'] ?? '') ?>">

        De:
        <select name="origem">
            <option value="C" <?= ($_POST['origem'] ?? 'C') === 'C' ? 'selected' : '' ?>>Celsius</option>
            <option value="F" <?= ($_POST['origem'] ?? '') === 'F' ? 'selected' : '' ?>>Fahrenheit</option>
            <option value="K" <?= ($_POST['origem'] ?? '') === 'K' ? 'selected' : '' ?>>Kelvin</option>
        </select>

        Para:
        <select name="destino">
            <option value="C" <?= ($_POST['destino'] ?? 'C') === 'C' ? 'selected' : '' ?>>Celsius</option>
            <option value="F" <?= ($_POST['destino'] ?? '') === 'F' ? 'selected' : '' ?>>Fahrenheit</option>
            <option value="K" <?= ($_POST['destino'] ?? '') === 'K' ? 'selected' : '' ?>>Kelvin</option>
        </select>

        <button>Converter</button>
    </form>

    <?php if ($ex === '06'): ?>
        <div class="resultado">
            <?= renderizar(
                converterTemperatura(
                    numero($_POST['valor'] ?? 0),
                    $_POST['origem'] ?? 'C',
                    $_POST['destino'] ?? 'C'
                )
            ) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex07">
    <legend>Exercício 07 - Sistema de Descontos</legend>
    <form method="post" action="formulario.php#ex07">
        <input type="hidden" name="ex" value="07">
        Valor da compra (R$):
        <input type="text" name="total" value="<?= e($_POST['total'] ?? '') ?>">
        <button>Calcular</button>
    </form>

    <?php if ($ex === '07'): ?>
        <div class="resultado">
            <?= renderizar(calcularDesconto(numero($_POST['total'] ?? 0))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex08">
    <legend>Exercício 08 - Organizador de Lista</legend>
    <form method="post" action="formulario.php#ex08">
        <input type="hidden" name="ex" value="08">
        Nomes separados por vírgula:<br>
        <textarea name="nomes" rows="2"><?= e($_POST['nomes'] ?? '') ?></textarea><br>
        <button>Ordenar</button>
    </form>

    <?php if ($ex === '08'): ?>
        <div class="resultado">
            <?= renderizar(ordenarNomes($_POST['nomes'] ?? '')) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex09">
    <legend>Exercício 09 - Verificador Matemático</legend>
    <form method="post" action="formulario.php#ex09">
        <input type="hidden" name="ex" value="09">
        Número inteiro:
        <input type="number" name="n" value="<?= e($_POST['n'] ?? '') ?>">
        <button>Analisar</button>
    </form>

    <?php if ($ex === '09'): ?>
        <div class="resultado">
            <?= renderizar(analisarNumero((int) ($_POST['n'] ?? 0))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex10">
    <legend>Exercício 10 - Sistema de Notas</legend>
    <form method="post" action="formulario.php#ex10">
        <input type="hidden" name="ex" value="10">
        Notas separadas por espaço:<br>
        <input type="text" name="notas" size="40" value="<?= e($_POST['notas'] ?? '') ?>">
        <button>Calcular</button>
    </form>

    <p>Aprovado: média >= 7 | Recuperação: média >= 5 | Reprovado: média < 5</p>

    <?php if ($ex === '10'): ?>
        <?php
        $notas = preg_replace('/,/', '.', $_POST['notas'] ?? '');
        ?>
        <div class="resultado">
            <?= renderizar(calcularMedia(parseNumeros($notas))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex11">
    <legend>Exercício 11 - Formatador de Relatórios</legend>
    <form method="post" action="formulario.php#ex11">
        <input type="hidden" name="ex" value="11">
        <textarea name="texto" rows="3"><?= e($_POST['texto'] ?? '') ?></textarea><br>
        <button>Formatar</button>
    </form>

    <?php if ($ex === '11'): ?>
        <div class="resultado">
            <?= renderizar(formatarTexto($_POST['texto'] ?? '')) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex12">
    <legend>Exercício 12 - Catálogo de Produtos</legend>
    <form method="post" action="formulario.php#ex12">
        <input type="hidden" name="ex" value="12">
        Um produto por linha, no formato <b>nome;preço</b>:<br>
        <textarea name="produtos" rows="5"><?= e($_POST['produtos'] ?? '') ?></textarea><br>

        Pesquisar produto:
        <input type="text" name="busca" value="<?= e($_POST['busca'] ?? '') ?>">

        <button>Analisar</button>
    </form>

    <?php if ($ex === '12'): ?>
        <div class="resultado">
            <?= renderizar(
                analisarProdutos(
                    parseProdutos($_POST['produtos'] ?? ''),
                    $_POST['busca'] ?? ''
                )
            ) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex13">
    <legend>Exercício 13 - Criptografia Simples</legend>
    <form method="post" action="formulario.php#ex13">
        <input type="hidden" name="ex" value="13">

        Mensagem:
        <input type="text" name="msg" size="40" value="<?= e($_POST['msg'] ?? '') ?>"><br>

        Deslocamento:
        <input type="number" name="desloc" value="<?= e($_POST['desloc'] ?? '') ?>">

        <button>Criptografar</button>
    </form>

    <?php if ($ex === '13'): ?>
        <?php
        $msg = $_POST['msg'] ?? '';
        $desloc = (int) ($_POST['desloc'] ?? 3);
        $cript = criptografarMensagem($msg, $desloc);
        $desc = descriptografarMensagem($cript, $desloc);
        ?>

        <div class="resultado">
            <?= renderizar([
                'Criptografada' => $cript,
                'Descriptografada' => $desc
            ]) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex14">
    <legend>Exercício 14 - Estatísticas Numéricas</legend>
    <form method="post" action="formulario.php#ex14">
        <input type="hidden" name="ex" value="14">
        Números separados por espaço:<br>
        <input type="text" name="nums" size="40" value="<?= e($_POST['nums'] ?? '') ?>">
        <button>Calcular</button>
    </form>

    <?php if ($ex === '14'): ?>
        <div class="resultado">
            <?= renderizar(estatisticasNumericas(parseNumeros($_POST['nums'] ?? ''))) ?>
        </div>
    <?php endif; ?>
</fieldset>

<fieldset id="ex15">
    <legend>Exercício 15 - Biblioteca de Funções</legend>

    <form method="post" action="formulario.php#ex15">
        <input type="hidden" name="ex" value="15">

        Peso (kg):
        <input type="text" name="peso" value="<?= e($_POST['peso'] ?? '70') ?>">

        Altura (m):
        <input type="text" name="altura" value="<?= e($_POST['altura'] ?? '1,75') ?>"><br>

        E-mail:
        <input type="text" name="email" value="<?= e($_POST['email'] ?? 'teste@email.com') ?>"><br>

        Nascimento:
        <input type="date" name="nasc" value="<?= e($_POST['nasc'] ?? '2000-01-15') ?>"><br>

        Valor:
        <input type="text" name="valor" value="<?= e($_POST['valor'] ?? '100') ?>">

        De:
        <select name="de">
            <option <?= ($_POST['de'] ?? 'BRL') === 'BRL' ? 'selected' : '' ?>>BRL</option>
            <option <?= ($_POST['de'] ?? '') === 'USD' ? 'selected' : '' ?>>USD</option>
            <option <?= ($_POST['de'] ?? '') === 'EUR' ? 'selected' : '' ?>>EUR</option>
        </select>

        Para:
        <select name="para">
            <option <?= ($_POST['para'] ?? 'USD') === 'BRL' ? 'selected' : '' ?>>BRL</option>
            <option <?= ($_POST['para'] ?? 'USD') === 'USD' ? 'selected' : '' ?>>USD</option>
            <option <?= ($_POST['para'] ?? '') === 'EUR' ? 'selected' : '' ?>>EUR</option>
        </select>

        <small>1 USD = R$ 5,00 | 1 EUR = R$ 5,50</small><br>

        Telefone:
        <input type="text" name="tel" value="<?= e($_POST['tel'] ?? '47999998888') ?>"><br>

        Senha:
        <input type="text" name="senha" value="<?= e($_POST['senha'] ?? 'Abc@1234') ?>"><br>

        Texto:
        <input type="text" name="texto" size="40" value="<?= e($_POST['texto'] ?? 'Programação PHP') ?>"><br>

        <button>Testar funções</button>
    </form>

    <?php if ($ex === '15'): ?>
        <?php
        $peso = numero($_POST['peso'] ?? '70');
        $altura = numero($_POST['altura'] ?? '1,75');
        $email = $_POST['email'] ?? 'teste@email.com';
        $nasc = $_POST['nasc'] ?? '2000-01-15';
        $valor = numero($_POST['valor'] ?? '100');
        $de = $_POST['de'] ?? 'BRL';
        $para = $_POST['para'] ?? 'USD';
        $tel = $_POST['tel'] ?? '47999998888';
        $senha = $_POST['senha'] ?? 'Abc@1234';
        $texto = $_POST['texto'] ?? 'Programação PHP';

        $demo = [
            '1. calcularIMC' => calcularIMC($peso, $altura),
            '2. validarEmail' => validarEmail($email),
            '3. gerarSenha' => gerarSenha(12),
            '4. contarVogais' => contarVogais($texto),
            '5. inverterTexto' => inverterTexto($texto)['Texto invertido'],
            '6. calcularIdade' => calcularIdade($nasc),
            '7. converterMoeda' => number_format(
                converterMoeda($valor, $de, $para),
                2,
                ',',
                '.'
            ) . ' ' . $para,
            '8. formatarTelefone' => formatarTelefone($tel),
            '9. saudacao' => saudacao(),
            '10. validarSenhaForte' => validarSenhaForte($senha),
            '11. mascararCpf' => mascararCpf('123.456.789-09')
        ];
        ?>

        <div class="resultado">
            <?= renderizar($demo) ?>
        </div>
    <?php endif; ?>
</fieldset>

</body>
</html>