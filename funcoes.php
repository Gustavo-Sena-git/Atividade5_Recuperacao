<?php
date_default_timezone_set('America/Sao_Paulo');

function e($v): string {
    return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
}

function numero($v): float {
    return (float) str_replace(',', '.', trim((string)$v));
}

function parseNumeros(string $s): array {
    $partes = preg_split('/\s+/', trim($s), -1, PREG_SPLIT_NO_EMPTY);
    return array_map('numero', $partes);
}

function semAcentos(string $t): string {
    $m = [
        'á'=>'a','à'=>'a','â'=>'a','ã'=>'a','ä'=>'a',
        'é'=>'e','è'=>'e','ê'=>'e','ë'=>'e',
        'í'=>'i','ì'=>'i','î'=>'i','ï'=>'i',
        'ó'=>'o','ò'=>'o','ô'=>'o','õ'=>'o','ö'=>'o',
        'ú'=>'u','ù'=>'u','û'=>'u','ü'=>'u','ç'=>'c'
    ];

    return strtr(mb_strtolower($t), $m);
}

function moeda(float $v): string {
    return 'R$ ' . number_format($v, 2, ',', '.');
}

function formatarValor($v): string {
    if (is_bool($v)) return $v ? 'Sim' : 'Não';
    if (is_float($v)) return number_format($v, 2, ',', '.');
    return e($v);
}

function renderizar($d): string {
    if (!is_array($d)) return formatarValor($d);

    $lista = array_keys($d) === range(0, count($d) - 1);
    $h = '<ul>';

    foreach ($d as $k => $v) {
        $h .= '<li>';

        if (!$lista) {
            $h .= '<b>' . e($k) . ':</b> ';
        }

        $h .= renderizar($v) . '</li>';
    }

    return $h . '</ul>';
}

function calcularFormula(float $x, float $y) {
    $soma = $x + $y;

    if ($soma == 0) {
        return 'Não é possível realizar a divisão (x + y = 0).';
    }

    return ($x ** 2 + $y ** 2) / $soma;
}

function inverterTexto(string $texto): array {
    return [
        'Texto invertido' => implode('', array_reverse(mb_str_split($texto))),
        'Caracteres do texto original' => mb_strlen($texto)
    ];
}

function mascararCpf(string $cpf): string {
    $digitos = preg_replace('/\D/', '', $cpf);
    $n = strlen($digitos);

    if ($n <= 4) return $digitos;

    return str_repeat('*', $n - 4) . substr($digitos, -4);
}

function gerarSenha(int $tam): string {
    $tam = max(1, min(128, $tam));

    $sets = [
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'abcdefghijklmnopqrstuvwxyz',
        '0123456789',
        '!@#$%&*?-_+='
    ];

    $todos = implode('', $sets);
    $chars = [];

    if ($tam >= 4) {
        foreach ($sets as $s) {
            $chars[] = $s[random_int(0, strlen($s) - 1)];
        }
    }

    while (count($chars) < $tam) {
        $chars[] = $todos[random_int(0, strlen($todos) - 1)];
    }

    for ($i = count($chars) - 1; $i > 0; $i--) {
        $j = random_int(0, $i);
        [$chars[$i], $chars[$j]] = [$chars[$j], $chars[$i]];
    }

    return implode('', $chars);
}

function analisarTexto(string $texto): array {
    $palavras = preg_split('/\s+/u', trim($texto), -1, PREG_SPLIT_NO_EMPTY);
    $base = semAcentos($texto);
    $vogais = preg_match_all('/[aeiou]/', $base);
    $letras = preg_match_all('/[a-z]/', $base);

    return [
        'Quantidade de palavras' => count($palavras),
        'Quantidade de caracteres' => mb_strlen($texto),
        'Quantidade de vogais' => $vogais,
        'Quantidade de consoantes' => $letras - $vogais
    ];
}

function converterTemperatura(float $valor, string $origem, string $destino): float {
    switch ($origem) {
        case 'C':
            $c = $valor;
            break;
        case 'F':
            $c = ($valor - 32) * 5 / 9;
            break;
        case 'K':
            $c = $valor - 273.15;
            break;
        default:
            $c = $valor;
    }

    switch ($destino) {
        case 'F':
            return $c * 9 / 5 + 32;
        case 'K':
            return $c + 273.15;
        default:
            return $c;
    }
}

function calcularDesconto(float $total): array {
    if ($total > 1000) {
        $perc = 30;
    } elseif ($total > 500) {
        $perc = 20;
    } elseif ($total > 100) {
        $perc = 10;
    } else {
        $perc = 0;
    }

    $desc = $total * $perc / 100;

    return [
        'Valor original' => moeda($total),
        'Desconto aplicado' => $perc . '% (' . moeda($desc) . ')',
        'Valor final' => moeda($total - $desc)
    ];
}

function ordenarNomes(string $nomes): array {
    $lista = array_filter(
        array_map('trim', explode(',', $nomes)),
        fn($n) => $n !== ''
    );

    usort($lista, fn($a, $b) => strcmp(semAcentos($a), semAcentos($b)));

    return $lista;
}

function ehPrimo(int $n): bool {
    if ($n < 2) return false;

    for ($i = 2; $i * $i <= $n; $i++) {
        if ($n % $i === 0) return false;
    }

    return true;
}

function ehPerfeito(int $n): bool {
    if ($n < 2) return false;

    $soma = 1;

    for ($i = 2; $i * $i <= $n; $i++) {
        if ($n % $i === 0) {
            $soma += $i;

            if ($i !== intdiv($n, $i)) {
                $soma += intdiv($n, $i);
            }
        }
    }

    return $soma === $n;
}

function analisarNumero(int $n): array {
    return [
        'Paridade' => $n % 2 === 0 ? 'Par' : 'Ímpar',
        'Primo' => ehPrimo($n),
        'Perfeito' => ehPerfeito($n)
    ];
}

function calcularMedia(array $notas): array {
    if (count($notas) === 0) {
        return ['Erro' => 'Informe ao menos uma nota.'];
    }

    $media = array_sum($notas) / count($notas);

    $situacao = $media >= 7
        ? 'Aprovado'
        : ($media >= 5 ? 'Recuperação' : 'Reprovado');

    return [
        'Maior nota' => (float) max($notas),
        'Menor nota' => (float) min($notas),
        'Média' => (float) $media,
        'Situação final' => $situacao
    ];
}

function formatarTexto(string $texto): array {
    return [
        'Maiúsculas' => mb_strtoupper($texto),
        'Minúsculas' => mb_strtolower($texto),
        'Primeira letra de cada palavra em maiúscula' => mb_convert_case($texto, MB_CASE_TITLE, 'UTF-8'),
        'Total de caracteres' => mb_strlen($texto)
    ];
}

function parseProdutos(string $texto): array {
    $produtos = [];

    foreach (preg_split('/\R/', trim($texto), -1, PREG_SPLIT_NO_EMPTY) as $linha) {
        $p = array_map('trim', explode(';', $linha));

        if (count($p) >= 2 && $p[0] !== '') {
            $produtos[] = [
                'nome' => $p[0],
                'preco' => numero($p[1])
            ];
        }
    }

    return $produtos;
}

function analisarProdutos(array $produtos, string $busca = ''): array {
    if (count($produtos) === 0) {
        return ['Erro' => 'Nenhum produto válido informado.'];
    }

    $caro = $barato = $produtos[0];
    $soma = 0;

    foreach ($produtos as $p) {
        if ($p['preco'] > $caro['preco']) {
            $caro = $p;
        }

        if ($p['preco'] < $barato['preco']) {
            $barato = $p;
        }

        $soma += $p['preco'];
    }

    $res = [
        'Produto mais caro' => $caro['nome'] . ' (' . moeda($caro['preco']) . ')',
        'Produto mais barato' => $barato['nome'] . ' (' . moeda($barato['preco']) . ')',
        'Média dos preços' => moeda($soma / count($produtos))
    ];

    if (trim($busca) !== '') {
        $achados = [];

        foreach ($produtos as $p) {
            if (mb_stripos($p['nome'], trim($busca)) !== false) {
                $achados[] = $p['nome'] . ' (' . moeda($p['preco']) . ')';
            }
        }

        $res['Pesquisa por "' . $busca . '"'] =
            count($achados) ? $achados : 'Nenhum produto encontrado.';
    }

    return $res;
}

function cifraCesar(string $texto, int $desloc): string {
    $desloc = (($desloc % 26) + 26) % 26;
    $out = '';

    foreach (str_split($texto) as $ch) {
        $o = ord($ch);

        if ($o >= 65 && $o <= 90) {
            $out .= chr((($o - 65 + $desloc) % 26) + 65);
        } elseif ($o >= 97 && $o <= 122) {
            $out .= chr((($o - 97 + $desloc) % 26) + 97);
        } else {
            $out .= $ch;
        }
    }

    return $out;
}

function criptografarMensagem(string $texto, int $desloc = 3): string {
    return cifraCesar($texto, $desloc);
}

function descriptografarMensagem(string $texto, int $desloc = 3): string {
    return cifraCesar($texto, -$desloc);
}

function estatisticasNumericas(array $nums): array {
    if (count($nums) === 0) {
        return ['Erro' => 'Informe ao menos um número.'];
    }

    $ord = $nums;
    sort($ord);

    $n = count($ord);

    if ($n % 2) {
        $mediana = $ord[intdiv($n, 2)];
    } else {
        $mediana = ($ord[$n / 2 - 1] + $ord[$n / 2]) / 2;
    }

    $pares = 0;
    $impares = 0;

    foreach ($nums as $x) {
        if (fmod($x, 1) != 0) continue;

        if (fmod($x, 2) == 0) {
            $pares++;
        } else {
            $impares++;
        }
    }

    return [
        'Soma' => (float) array_sum($nums),
        'Média' => array_sum($nums) / $n,
        'Maior valor' => (float) max($nums),
        'Menor valor' => (float) min($nums),
        'Mediana' => (float) $mediana,
        'Quantidade de pares' => $pares,
        'Quantidade de ímpares' => $impares
    ];
}

function calcularIMC(float $peso, float $altura): array {
    if ($altura <= 0) {
        return ['Erro' => 'Altura inválida.'];
    }

    $imc = $peso / ($altura ** 2);

    if ($imc < 18.5) {
        $c = 'Abaixo do peso';
    } elseif ($imc < 25) {
        $c = 'Peso normal';
    } elseif ($imc < 30) {
        $c = 'Sobrepeso';
    } else {
        $c = 'Obesidade';
    }

    return [
        'IMC' => (float) $imc,
        'Classificação' => $c
    ];
}

function validarEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function contarVogais(string $texto): int {
    return analisarTexto($texto)['Quantidade de vogais'];
}

function calcularIdade(string $nascimento) {
    try {
        $n = new DateTime($nascimento);
    } catch (Exception $ex) {
        return 'Data inválida.';
    }

    return (new DateTime())->diff($n)->y;
}

function converterMoeda(float $valor, string $de, string $para): float {
    $taxas = [
        'BRL' => 1.0,
        'USD' => 5.00,
        'EUR' => 5.50
    ];

    return $valor * $taxas[$de] / $taxas[$para];
}

function formatarTelefone(string $tel): string {
    $d = preg_replace('/\D/', '', $tel);

    if (strlen($d) === 11) {
        return sprintf(
            '(%s) %s-%s',
            substr($d, 0, 2),
            substr($d, 2, 5),
            substr($d, 7)
        );
    }

    if (strlen($d) === 10) {
        return sprintf(
            '(%s) %s-%s',
            substr($d, 0, 2),
            substr($d, 2, 4),
            substr($d, 6)
        );
    }

    return 'Telefone inválido (use 10 ou 11 dígitos).';
}

function saudacao(?int $hora = null): string {
    $hora = $hora ?? (int) date('H');

    if ($hora < 12) return 'Bom dia!';
    if ($hora < 18) return 'Boa tarde!';

    return 'Boa noite!';
}

function validarSenhaForte(string $s): array {
    $falta = [];

    if (strlen($s) < 8) $falta[] = 'mínimo de 8 caracteres';
    if (!preg_match('/[A-Z]/', $s)) $falta[] = 'letra maiúscula';
    if (!preg_match('/[a-z]/', $s)) $falta[] = 'letra minúscula';
    if (!preg_match('/\d/', $s)) $falta[] = 'número';
    if (!preg_match('/[^A-Za-z0-9]/', $s)) $falta[] = 'caractere especial';

    return [
        'Senha forte' => count($falta) === 0,
        'Faltando' => count($falta) ? $falta : 'nada'
    ];
}
