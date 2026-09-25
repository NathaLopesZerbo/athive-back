<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

function retornaUuidArquivo($web_path_foto)
{
    return substr($web_path_foto, strrpos($web_path_foto, "/") + 1, strrpos($web_path_foto, '.') - strrpos($web_path_foto, "/") - 1);
}

function retornaCaminhoArquivo($web_path_foto)
{
    return dirname($web_path_foto);
}

function retornaExtensaoArquivo($web_path_foto)
{
    return substr($web_path_foto, strrpos($web_path_foto, "."));
}

/**
 * @param        $table
 * @param string $extra
 * @return int
 */
function nextId($table, $extra = '')
{
    $db = \Illuminate\Support\Facades\DB::select("
    SET NOCOUNT ON
    DECLARE @resultado NUMERIC
    EXEC p_crm_sequenciador ?, ?, @resultado output
    SET NOCOUNT OFF

    SELECT @resultado id
    ", [$table, $extra]);

    return (int)$db[0]->id;
}


function maskedCpnjCpf($codigo, $uf = 'SP')
{
    $maskared = '';

    if (strlen($codigo) === 14 && $uf <> 'EX') {
        $maskared = maskedInput($codigo, '##.###.###/####-##');
    } elseif (strlen($codigo) === 11 && $uf <> 'EX') {
        $maskared = maskedInput($codigo, '###.###.###-##');
    } else {
        $maskared = $codigo;
    }

    return $maskared;
}

function maskedTelCel($numero)
{
    $maskared = '';

    if (strlen($numero) === 10) {
        $maskared = maskedInput($numero, '(##) ####-####');
    } else {
        $maskared = maskedInput($numero, '(##) #####-####');;
    }

    return $maskared;
}

function maskedInput($resource, $mask)
{
    $maskared = '';
    $k        = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($resource[$k])) {
                $maskared .= $resource[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

function setDate($value)
{
    if (trim($value) == '') {
        return null;
    }

    return \DateTime::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
}

function convertDate($value, $format = 'Y-m-d')
{
    if (trim($value) == '') {
        return '';
    }

    return date($format, strtotime($value));
}

function dataPorExtenso($data) {
    Carbon::setLocale('pt_BR');
    $date = Carbon::parse($data);
    return ucfirst($date->isoFormat('DD [de] MMMM [de] YYYY'));
}

function applyDateBetween($query, ?string $campo, array $filtros)
{
    $data_ini = $filtros['data_ini'] ?? null;
    $data_fim = $filtros['data_fim'] ?? null;

    if (!$campo || !$data_ini || !$data_fim) {
        return $query;
    }

    return $query->whereBetween($campo, [$data_ini, $data_fim]);
}


function preencheStr($tamanho, $variavel, $preenchimento, $orientacao = 'E')
{
    $result = '';

    for ($i = 1; $i <= $tamanho - strlen($variavel); $i++) {
        $result .= $preenchimento;
    }

    if ($orientacao == 'D') {
        $result = $variavel . $result;
    } else {
        $result .= $variavel;
    }

    return $result;
}

function decodeBase64(String $string)
{
    $base64 = explode(',', $string)[1];

    return base64_decode($base64, $strict = false);
}

function crm_tab_temporaria($number)
{
    $sql_tmp = "SELECT";

    for ($i = 1; $i <= $number; $i++) {
        $sql_tmp .= " dbo.CRM_TAB_TEMPORARIA('Tmp','{$i}') tab{$i},";
    }
    $sql_tmp = substr_replace($sql_tmp, ' ', -1);

    return DB::select($sql_tmp);
}

function crm_apaga_tab_temporaria(array $tables)
{
    $sql = "";

    foreach ($tables as $table) {
        if (substr($table, 0, 3) === 'CRM' && substr($table, -2) === '__') {
            $sql .= "
        IF OBJECT_ID('dbo.$table', 'U') IS NOT NULL
            DROP TABLE dbo.$table
        ";
        }
    }

    if ($sql) {
        return DB::insert($sql);
    }

    return true;
}

function geraProximoCodigo(String $table, String $campo)
{
    $ultimoCodigo = DB::table($table)->max($campo);

    if (!$ultimoCodigo) {
        return '0001';
    }

    return str_pad((int)$ultimoCodigo + 1, 4, '0', STR_PAD_LEFT);
}

function CriptoSenha($iUsuCodigo, $sSenha)
{
    if ($sSenha == "") {
        $result = " ";
    } else {
        $result = $sSenha;
    }

    for ($I = 0; $I <= strlen($result) - 1; ++$I) {
        $B = Ord($result[$I]) ^ intval($iUsuCodigo);

        //somando os 4 bytes do inteiro
        $D = _BF_SHR32(($B << 24), 24);      //1 byte
        $D = $D + _BF_SHR32(($B << 16), 24); //2 byte
        $D = $D + _BF_SHR32(($B << 8), 24);  //3 byte
        $D = $D + _BF_SHR32($B, 24);         //4 byte
        //somando os possiveis 2 bytes do inteiro
        $B = $D;
        $D = _BF_SHR32(($B << 24), 24);      //1 byte
        $D = $D + _BF_SHR32(($B << 16), 24);  //2 byte

        $result[$I] = Chr($D);
    }

    return (strtoupper(md5($result)));
}

function _BF_SHR32($x, $bits)
{
    if ($bits == 0) {
        return $x;
    }
    if ($bits == 32) {
        return 0;
    }
    $y = ($x & 0x7FFFFFFF) >> $bits;
    if (0x80000000 & $x) {
        $y |= (1 << (31 - $bits));
    }

    return $y;
}

function toPolishNotation(string $expression): string
{
    $tokens = preg_split("/([\s\+\-\*\/\^\(\)])/u", $expression, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    $output     = [];
    $operadores = [];

    $precedencia = [
        '+'   => 1,
        '-'   => 1,
        '===' => 1,
        '<>'  => 1,
        '>'   => 1,
        '>='  => 1,
        '<'   => 1,
        '<='  => 1,
        '*'   => 2,
        '/'   => 2,
        '^'   => 3,
    ];

    foreach ($tokens as $token) {
        if (preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $token) || is_numeric($token)) {
            $output[] = $token;
            continue;
        }

        // Se for um operador
        if (in_array($token, ['+', '-', '*', '/', '^', '===', '<>', '>', '>=', '<', '<='])) {
            while (!empty($operadores) && end($operadores) !== '(' && $precedencia[end($operadores)] >= $precedencia[$token]) {
                $output[] = array_pop($operadores);
            }
            $operadores[] = $token;
            continue;
        }

        // Se for um parêntese de abertura
        if ($token === '(') {
            $operadores[] = $token;
            continue;
        }

        // Se for um parêntese de fechamento remove o parêntese de abertura
        if ($token === ')') {
            while (!empty($operadores) && end($operadores) !== '(') {
                $output[] = array_pop($operadores);
            }

            array_pop($operadores);
        }
    }

    // Adiciona operadores restantes à saída
    while (!empty($operadores)) {
        $output[] = array_pop($operadores);
    }

    return implode(' ', $output);
}

function calculatePolishNotation(string $polishNotation)
{
    $tokens = explode(' ', $polishNotation);
    $stack  = [];

    foreach ($tokens as $token) {
        // Se for um número ou variável, empilhe na pilha
        if (is_numeric($token) || preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $token)) {
            $stack[] = $token;
            continue;
        }

        // Se for um operador, desempilhe os operandos, aplique o operador e empilhe o resultado
        if (in_array($token, ['+', '-', '*', '/', '^', '===', '<>', '>', '>=', '<', '<='])) {
            $operand2 = array_pop($stack);
            $operand1 = array_pop($stack);

            match ($token) {
                '+' => $stack[] = $operand1 + $operand2,
                '-' => $stack[] = $operand1 - $operand2,
                '*' => $stack[] = $operand1 * $operand2,
                '/' => $stack[] = $operand1 / $operand2,
                '^' => $stack[] = pow($operand1, $operand2),
                '===' => $stack[] = $operand1 == $operand2,
                '<>' => $stack[] = $operand1 != $operand2,
                '>' => $stack[] = $operand1 > $operand2,
                '>=' => $stack[] = $operand1 >= $operand2,
                '<' => $stack[] = $operand1 < $operand2,
                '<=' => $stack[] = $operand1 <= $operand2
            };
        }
    }

    // O resultado final estará no topo da pilha
    return end($stack);
}

function checkPolishNotation(string $polishNotation): bool
{
    $tokens = preg_split("/\s+/", $polishNotation, -1, PREG_SPLIT_NO_EMPTY);
    $pilha  = [];

    foreach ($tokens as $token) {
        if (is_numeric($token) || preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $token)) {
            array_push($pilha, $token);
            continue;
        }

        if (in_array($token, ['+', '-', '*', '/', '^', '===', '<>', '>', '>=', '<', '<='])) {
            if (count($pilha) < 2) {
                return false;
            }

            array_pop($pilha);
            array_pop($pilha);
            array_push($pilha, $token);
            continue;
        }

        return false;
    }

    return count($pilha) == 1;
}

function maximoId(string $tabela, string $coluna, string $clausula = '')
{
    $query = DB::table($tabela)->selectRaw("IFNULL(MAX($coluna), 0) + 1 as maximo");

    if ($clausula != '') {
        $query->whereRaw($clausula);
    }

    return $query->first()->maximo;
}

function valorPorExtenso( $valor = 0, $bolExibirMoeda = true, $bolPalavraFeminina = false, $maiuscula = true )
{
    $singular = null;
    $plural   = null;

    if ( $bolExibirMoeda )
    {
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural   = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
    }
    else
    {
        $singular = array("", "", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural   = array("", "", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
    }

    $c   = array("", "cem", "duzentos", "trezentos", "quatrocentos","quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
    $d   = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta","sessenta", "setenta", "oitenta", "noventa");
    $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze","dezesseis", "dezessete", "dezoito", "dezenove");
    $u   = array("", "um", "dois", "três", "quatro", "cinco", "seis","sete", "oito", "nove");

    if ( $bolPalavraFeminina )
    {

        if ($valor == 1)
        {
            $u = array("", "uma", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
        }
        else
        {
            $u = array("", "um", "duas", "três", "quatro", "cinco", "seis","sete", "oito", "nove");
        }

        $c = array("", "cem", "duzentas", "trezentas", "quatrocentas","quinhentas", "seiscentas", "setecentas", "oitocentas", "novecentas");
    }


    $z = 0;

    $valor   = number_format( $valor, 2, ".", "." );
    $inteiro = explode( ".", $valor );

    for ( $i = 0; $i < count( $inteiro ); $i++ )
    {
        for ( $ii = mb_strlen( $inteiro[$i] ); $ii < 3; $ii++ )
        {
            $inteiro[$i] = "0" . $inteiro[$i];
        }
    }

    $rt  = null;
    $fim = count( $inteiro ) - ($inteiro[count( $inteiro ) - 1] > 0 ? 1 : 2);
    for ( $i = 0; $i < count( $inteiro ); $i++ )
    {
        $valor = $inteiro[$i];
        $rc    = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd    = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru    = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r  = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
        $t  = count( $inteiro ) - 1 - $i;
        $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ( $valor == "000")
            $z++;
        elseif ( $z > 0 )
            $z--;

        if ( ($t == 1) && ($z > 0) && ($inteiro[0] > 0) )
            $r .= ( ($z > 1) ? " de " : "") . $plural[$t];

        if ( $r )
            $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    $rt = mb_substr( $rt, 1 );

    $valor_extenso = ($rt ? trim( $rt ) : "zero");

    return $maiuscula ? mb_strtoupper( $valor_extenso ) : $valor_extenso;
}

function removeNonNumeric(string $value): int
{
    $numericValue = preg_replace('/[^\d]/', '', $value);

    return (int)$numericValue;
}

function validationLang(string $attribute, string $type ='required'): string{
    $campo = Lang::get("validation.attributes.$attribute");

    return Lang::get("validation.$type", ['attribute' => $campo]);
}

/**
 * Retirado de: http://www.geradorcpf.com/script-validar-cpf-php.htm
 *
 * @param null $cpf
 * @return bool
 */
function isCPF($cpf = null)
{

    if (empty($cpf)) {
        return false;
    }

    $cpf = preg_replace('/[^\d]/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    } else {
        if (
            $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' ||
            $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'
        ) {
            return false;
        } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}

function isIE($ie, $uf)
{

    if (strtoupper($ie) == "ISENTO") {
        return true;
    } else {

        $uf = strtoupper($uf);
        $ie = preg_replace("/[^0-9]/", "", $ie);

        switch ($uf) {
            //Acre
            case 'AC':
                if (strlen($ie) != 13) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != '01') {
                        return false;
                    } else {
                        $b = 4;
                        $soma = 0;
                        for ($i = 0; $i <= 10; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                            if ($b == 1) {
                                $b = 9;
                            }
                        }
                        $dig = 11 - ($soma % 11);
                        if ($dig >= 10) {
                            $dig = 0;
                        }
                        if (!($dig == $ie[11])) {
                            return false;
                        } else {
                            $b = 5;
                            $soma = 0;
                            for ($i = 0; $i <= 11; $i++) {
                                $soma += $ie[$i] * $b;
                                $b--;
                                if ($b == 1) {
                                    $b = 9;
                                }
                            }
                            $dig = 11 - ($soma % 11);
                            if ($dig >= 10) {
                                $dig = 0;
                            }

                            return ($dig == $ie[12]);
                        }
                    }
                }
                break;

            // Alagoas
            case 'AL':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != '24') {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $soma *= 10;
                        $dig = $soma - (((int)($soma / 11)) * 11);
                        if ($dig == 10) {
                            $dig = 0;
                        }

                        return ($dig == $ie[8]);
                    }
                }
                break;

            //Amazonas
            case 'AM':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    if ($soma <= 11) {
                        $dig = 11 - $soma;
                    } else {
                        $r = $soma % 11;
                        if ($r <= 1) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $r;
                        }
                    }

                    return ($dig == $ie[8]);
                }
                break;

            //Amapá
            case 'AP':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != '03') {
                        return false;
                    } else {
                        $i = substr($ie, 0, -1);
                        if (($i >= 3000001) && ($i <= 3017000)) {
                            $p = 5;
                            $d = 0;
                        } elseif (($i >= 3017001) && ($i <= 3019022)) {
                            $p = 9;
                            $d = 1;
                        } elseif ($i >= 3019023) {
                            $p = 0;
                            $d = 0;
                        }

                        $b = 9;
                        $soma = $p;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $dig = 11 - ($soma % 11);
                        if ($dig == 10) {
                            $dig = 0;
                        } elseif ($dig == 11) {
                            $dig = $d;
                        }

                        return ($dig == $ie[8]);
                    }
                }
                break;

            //Bahia
            case 'BA':
                if (strlen($ie) != 8) {
                    return false;
                } else {

                    $arr1 = array('0', '1', '2', '3', '4', '5', '8');
                    $arr2 = array('6', '7', '9');

                    $i = substr($ie, 0, 1);

                    if (in_array($i, $arr1)) {
                        $modulo = 10;
                    } elseif (in_array($i, $arr2)) {
                        $modulo = 11;
                    }

                    $b = 7;
                    $soma = 0;
                    for ($i = 0; $i <= 5; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }

                    $i = $soma % $modulo;
                    if ($modulo == 10) {
                        if ($i == 0) {
                            $dig = 0;
                        } else {
                            $dig = $modulo - $i;
                        }
                    } else {
                        if ($i <= 1) {
                            $dig = 0;
                        } else {
                            $dig = $modulo - $i;
                        }
                    }
                    if (!($dig == $ie[7])) {
                        return false;
                    } else {
                        $b = 8;
                        $soma = 0;
                        for ($i = 0; $i <= 5; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $soma += $ie[7] * 2;
                        $i = $soma % $modulo;
                        if ($modulo == 10) {
                            if ($i == 0) {
                                $dig = 0;
                            } else {
                                $dig = $modulo - $i;
                            }
                        } else {
                            if ($i <= 1) {
                                $dig = 0;
                            } else {
                                $dig = $modulo - $i;
                            }
                        }

                        return ($dig == $ie[6]);
                    }
                }
                break;

            //Ceará
            case 'CE':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $dig = 11 - ($soma % 11);

                    if ($dig >= 10) {
                        $dig = 0;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            // Distrito Federal
            case 'DF':
                if (strlen($ie) != 13) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != '07') {
                        return false;
                    } else {
                        $b = 4;
                        $soma = 0;
                        for ($i = 0; $i <= 10; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                            if ($b == 1) {
                                $b = 9;
                            }
                        }
                        $dig = 11 - ($soma % 11);
                        if ($dig >= 10) {
                            $dig = 0;
                        }

                        if (!($dig == $ie[11])) {
                            return false;
                        } else {
                            $b = 5;
                            $soma = 0;
                            for ($i = 0; $i <= 11; $i++) {
                                $soma += $ie[$i] * $b;
                                $b--;
                                if ($b == 1) {
                                    $b = 9;
                                }
                            }
                            $dig = 11 - ($soma % 11);
                            if ($dig >= 10) {
                                $dig = 0;
                            }

                            return ($dig == $ie[12]);
                        }
                    }
                }
                break;

            //Espirito Santo
            case 'ES':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $i = $soma % 11;
                    if ($i < 2) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            //Goias
            case 'GO':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $s = substr($ie, 0, 2);

                    if (!(($s == 10) || ($s == 11) || ($s == 15))) {
                        return false;
                    } else {
                        $n = substr($ie, 0, 7);

                        if ($n == 11094402) {
                            if ($ie[8] != 0) {
                                if ($ie[8] != 1) {
                                    return false;
                                } else {
                                    return true;
                                }
                            } else {
                                return 1;
                            }
                        } else {
                            $b = 9;
                            $soma = 0;
                            for ($i = 0; $i <= 7; $i++) {
                                $soma += $ie[$i] * $b;
                                $b--;
                            }
                            $i = $soma % 11;
                            if ($i == 0) {
                                $dig = 0;
                            } else {
                                if ($i == 1) {
                                    if (($n >= 10103105) && ($n <= 10119997)) {
                                        $dig = 1;
                                    } else {
                                        $dig = 0;
                                    }
                                } else {
                                    $dig = 11 - $i;
                                }
                            }

                            return ($dig == $ie[8]);
                        }
                    }
                }
                break;

            // Maranhão
            case 'MA':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != 12) {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $i = $soma % 11;
                        if ($i <= 1) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        return ($dig == $ie[8]);
                    }
                }
                break;

            // Mato Grosso
            case 'MT':
                if (strlen($ie) != 11) {
                    return false;
                } else {
                    $b = 3;
                    $soma = 0;
                    for ($i = 0; $i <= 9; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 1) {
                            $b = 9;
                        }
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    return ($dig == $ie[10]);
                }
                break;

            // Mato Grosso do Sul
            case 'MS':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != 28) {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $i = $soma % 11;
                        if ($i == 0) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        if ($dig > 9) {
                            $dig = 0;
                        }

                        return ($dig == $ie[8]);
                    }
                }
                break;

            //Minas Gerais
            case 'MG':
                if (strlen($ie) != 13) {
                    return false;
                } else {
                    $ie2 = substr($ie, 0, 3) . '0' . substr($ie, 3);

                    $b = 1;
                    $soma = "";
                    for ($i = 0; $i <= 11; $i++) {
                        $soma .= $ie2[$i] * $b;
                        $b++;
                        if ($b == 3) {
                            $b = 1;
                        }
                    }
                    $s = 0;
                    for ($i = 0; $i < strlen($soma); $i++) {
                        $s += $soma[$i];
                    }
                    $i = substr($ie2, 9, 2);
                    $dig = $i - $s;
                    if ($dig != $ie[11]) {
                        return false;
                    } else {
                        $b = 3;
                        $soma = 0;
                        for ($i = 0; $i <= 11; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                            if ($b == 1) {
                                $b = 11;
                            }
                        }
                        $i = $soma % 11;
                        if ($i < 2) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        };

                        return ($dig == $ie[12]);
                    }
                }
                break;

            //Pará
            case 'PA':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != 15) {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $i = $soma % 11;
                        if ($i <= 1) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        return ($dig == $ie[8]);
                    }
                }
                break;

            //Paraíba
            case 'PB':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    if ($dig > 9) {
                        $dig = 0;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            //Paraná
            case 'PR':
                if (strlen($ie) != 10) {
                    return false;
                } else {
                    $b = 3;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 1) {
                            $b = 7;
                        }
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    if (!($dig == $ie[8])) {
                        return false;
                    } else {
                        $b = 4;
                        $soma = 0;
                        for ($i = 0; $i <= 8; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                            if ($b == 1) {
                                $b = 7;
                            }
                        }
                        $i = $soma % 11;
                        if ($i <= 1) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        return ($dig == $ie[9]);
                    }
                }
                break;

            //Pernambuco
            case 'PE':
                if (strlen($ie) == 9) {
                    $b = 8;
                    $soma = 0;
                    for ($i = 0; $i <= 6; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    if (!($dig == $ie[7])) {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b--;
                        }
                        $i = $soma % 11;
                        if ($i <= 1) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        return ($dig == $ie[8]);
                    }
                } elseif (strlen($ie) == 14) {
                    $b = 5;
                    $soma = 0;
                    for ($i = 0; $i <= 12; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 0) {
                            $b = 9;
                        }
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig > 9) {
                        $dig = $dig - 10;
                    }

                    return ($dig == $ie[13]);
                } else {
                    return false;
                }
                break;

            //Piauí
            case 'PI':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }
                    if ($dig >= 10) {
                        $dig = 0;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            // Rio de Janeiro
            case 'RJ':
                if (strlen($ie) != 8) {
                    return false;
                } else {
                    $b = 2;
                    $soma = 0;
                    for ($i = 0; $i <= 6; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 1) {
                            $b = 7;
                        }
                    }
                    $i = $soma % 11;
                    if ($i <= 1) {
                        $dig = 0;
                    } else {
                        $dig = 11 - $i;
                    }

                    return ($dig == $ie[7]);
                }
                break;

            //Rio Grande do Norte
            case 'RN':
                if (!((strlen($ie) == 9) || (strlen($ie) == 10))) {
                    return false;
                } else {
                    $b = strlen($ie);
                    if ($b == 9) {
                        $s = 7;
                    } else {
                        $s = 8;
                    }
                    $soma = 0;
                    for ($i = 0; $i <= $s; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $soma *= 10;
                    $dig = $soma % 11;
                    if ($dig == 10) {
                        $dig = 0;
                    }

                    $s += 1;
                    return ($dig == $ie[$s]);
                }
                break;

            // Rio Grande do Sul
            case 'RS':
                if (strlen($ie) != 10) {
                    return false;
                } else {
                    $b = 2;
                    $soma = 0;
                    for ($i = 0; $i <= 8; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 1) {
                            $b = 9;
                        }
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig >= 10) {
                        $dig = 0;
                    }

                    return ($dig == $ie[9]);
                }
                break;

            // Rondônia
            case 'RO':
                if (strlen($ie) == 9) {
                    $b = 6;
                    $soma = 0;
                    for ($i = 3; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig >= 10) {
                        $dig = $dig - 10;
                    }

                    return ($dig == $ie[8]);
                } elseif (strlen($ie) == 14) {
                    $b = 6;
                    $soma = 0;
                    for ($i = 0; $i <= 12; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                        if ($b == 1) {
                            $b = 9;
                        }
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig > 9) {
                        $dig = $dig - 10;
                    }

                    return ($dig == $ie[13]);
                } else {
                    return false;
                }
                break;

            //Roraima
            case 'RR':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    if (substr($ie, 0, 2) != 24) {
                        return false;
                    } else {
                        $b = 1;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b++;
                        }
                        $dig = $soma % 9;

                        return ($dig == $ie[8]);
                    }
                }
                break;

            //Santa Catarina
            case 'SC':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig <= 1) {
                        $dig = 0;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            //São Paulo
            case 'SP':
                if (strtoupper(substr($ie, 0, 1))  == 'P') {
                    if (strlen($ie) != 13) {
                        return false;
                    } else {
                        $b = 1;
                        $soma = 0;
                        for ($i = 1; $i <= 8; $i++) {
                            $soma += $ie[$i] * $b;
                            $b++;
                            if ($b == 2) {
                                $b = 3;
                            }
                            if ($b == 9) {
                                $b = 10;
                            }
                        }
                        $dig = $soma % 11;
                        return ($dig == $ie[9]);
                    }
                } else {
                    if (strlen($ie) != 12) {
                        return false;
                    } else {
                        $b = 1;
                        $soma = 0;
                        for ($i = 0; $i <= 7; $i++) {
                            $soma += $ie[$i] * $b;
                            $b++;
                            if ($b == 2) {
                                $b = 3;
                            }
                            if ($b == 9) {
                                $b = 10;
                            }
                        }
                        $dig = $soma % 11;
                        if ($dig > 9) {
                            $dig = 0;
                        }

                        if ($dig != $ie[8]) {
                            return false;
                        } else {
                            $b = 3;
                            $soma = 0;
                            for ($i = 0; $i <= 10; $i++) {
                                $soma += $ie[$i] * $b;
                                $b--;
                                if ($b == 1) {
                                    $b = 10;
                                }
                            }
                            $dig = $soma % 11;

                            return ($dig == $ie[11]);
                        }
                    }
                }
                break;

            //Sergipe
            case 'SE':
                if (strlen($ie) != 9) {
                    return false;
                } else {
                    $b = 9;
                    $soma = 0;
                    for ($i = 0; $i <= 7; $i++) {
                        $soma += $ie[$i] * $b;
                        $b--;
                    }
                    $dig = 11 - ($soma % 11);
                    if ($dig > 9) {
                        $dig = 0;
                    }

                    return ($dig == $ie[8]);
                }
                break;

            //Tocantins
            case 'TO':
                if (strlen($ie) != 11) {
                    return false;
                } else {
                    $s = substr($ie, 2, 2);
                    if (!(($s == '01') || ($s == '02') || ($s == '03') || ($s == '99'))) {
                        return false;
                    } else {
                        $b = 9;
                        $soma = 0;
                        for ($i = 0; $i <= 9; $i++) {
                            if (!(($i == 2) || ($i == 3))) {
                                $soma += $ie[$i] * $b;
                                $b--;
                            }
                        }
                        $i = $soma % 11;
                        if ($i < 2) {
                            $dig = 0;
                        } else {
                            $dig = 11 - $i;
                        }

                        return ($dig == $ie[10]);
                    }
                }
                break;

            default:
                return false;
                break;
        }
    }
}


/**
 * Multiplicação do CNPJ
 *
 * @param string $cnpj Os digitos do CNPJ
 * @param int    $posicoes A posição que vai iniciar a regressão
 * @return int O
 *
 */
function multiplica_cnpj($cnpj, $posicao = 5)
{
    // Variável para o cálculo
    $calculo = 0;

    // Laço para percorrer os item do cnpj
    for ($i = 0; $i < strlen($cnpj); $i++) {
        // Cálculo mais posição do CNPJ * a posição
        $calculo = $calculo + ($cnpj[$i] * $posicao);

        // Decrementa a posição a cada volta do laço
        $posicao--;

        // Se a posição for menor que 2, ela se torna 9
        if ($posicao < 2) {
            $posicao = 9;
        }
    }

    // Retorna o cálculo
    return $calculo;
}

/**
 * retirado de: http://www.todoespacoonline.com/w/2014/08/03/validar-cnpj-com-php/
 *
 * @param $cnpj
 * @return bool
 * @author Luiz Otávio Miranda <contato@todoespacoonline.com/w>
 *
 */
function isCNPJ($cnpj)
{
    // Deixa o CNPJ com apenas números
    $cnpj = preg_replace('/[^\d]/', '', $cnpj);

    // Garante que o CNPJ é uma string
    $cnpj = (string)$cnpj;

    // O valor original
    $cnpj_original = $cnpj;

    // Captura os primeiros 12 números do CNPJ
    $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

    // Faz o primeiro cálculo
    $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);

    // Se o resto da divisão entre o primeiro cálculo e 11 for menor que 2, o primeiro
    // Dígito é zero (0), caso contrário é 11 - o resto da divisão entre o cálculo e 11
    $primeiro_digito = ($primeiro_calculo % 11) < 2 ? 0 : 11 - ($primeiro_calculo % 11);

    // Concatena o primeiro dígito nos 12 primeiros números do CNPJ
    // Agora temos 13 números aqui
    $primeiros_numeros_cnpj .= $primeiro_digito;

    // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
    $segundo_digito  = ($segundo_calculo % 11) < 2 ? 0 : 11 - ($segundo_calculo % 11);

    // Concatena o segundo dígito ao CNPJ
    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

    // Verifica se o CNPJ gerado é idêntico ao enviado
    if ($cnpj === $cnpj_original) {
        return true;
    }
}

function nextIdItem($id_pedido, $table = 'vnd_itens_pedido_net', $field_where = 'id_pedido', $field_max = 'id_itens')
{
    $db = DB::select("
    SELECT IFNULL(MAX({$field_max}), 0) + 1 max_id
    FROM {$table}
    WHERE {$field_where} = ?
    ", [$id_pedido]);

    return (count($db)) ? $db[0]->max_id : 1;
}

function dataValida(Carbon $data, bool $sabado = true, 
bool $domingo = true, bool $feriado = true): Carbon
{
    while (true) {
        if (($sabado && $data->isSaturday()) ||
            ($domingo && $data->isSunday()) ){
                
            $data->addDay();
            continue;
        }
        if ($feriado) {
            $isFeriado = DB::table('sec_calendario_academico_data')
                ->where('id_motivo', 2)
                ->where('cal_data', $data->format('Y-m-d'))
                ->exists();

            if ($isFeriado) {
                $data->addDay();
                continue;
            }
        }
        
        return $data;
    }
}

function cleanAggregate(Builder $query): Builder
{
    return (clone $query)
        ->reorder()
        ->select([]);
}


