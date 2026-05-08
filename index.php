<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Pessoa
{
    private string $nome;
    private int $idade;
    private string $cidade;
    private int $numeroPessoas;
    private string $estiloVida;

    public function __construct(string $nome, int $idade, string $cidade, int $numeroPessoas, string $estiloVida)
    {
        $this->setNome($nome);
        $this->setIdade($idade);
        $this->setCidade($cidade);
        $this->setNumeroPessoas($numeroPessoas);
        $this->setEstiloVida($estiloVida);
    }

    public function getNome(): string { return $this->nome; }
    public function getIdade(): int { return $this->idade; }
    public function getCidade(): string { return $this->cidade; }
    public function getNumeroPessoas(): int { return $this->numeroPessoas; }
    public function getEstiloVida(): string { return $this->estiloVida; }

    public function setNome(string $nome): void
    {
        if (empty($nome)) throw new InvalidArgumentException("Nome não pode ser vazio.");
        $this->nome = $nome;
    }

    public function setIdade(int $idade): void
    {
        if ($idade <= 0) throw new InvalidArgumentException("Idade deve ser maior que zero.");
        $this->idade = $idade;
    }

    public function setCidade(string $cidade): void
    {
        if (empty($cidade)) throw new InvalidArgumentException("Cidade não pode ser vazia.");
        $this->cidade = $cidade;
    }

    public function setNumeroPessoas(int $numeroPessoas): void
    {
        if ($numeroPessoas <= 0) throw new InvalidArgumentException("Número de pessoas deve ser maior que zero.");
        $this->numeroPessoas = $numeroPessoas;
    }

    public function setEstiloVida(string $estiloVida): void
    {
        if (!in_array($estiloVida, ['baixo', 'medio', 'alto']))
            throw new InvalidArgumentException("Estilo de vida inválido.");
        $this->estiloVida = $estiloVida;
    }

    public function getFatorEstiloVida(): float
    {
        return match ($this->estiloVida) {
            'baixo' => 0.8,
            'medio' => 1.0,
            'alto'  => 1.2,
            default => 1.0
        };
    }

    public function exibirResumo(): string
    {
        return "Nome: {$this->nome} <br>
        Idade: {$this->idade} <br>
        Cidade: {$this->cidade} <br>
        Pessoas na residência: {$this->numeroPessoas} <br>
        Estilo de vida: {$this->estiloVida}";
    }
}

class FonteEmissao
{
    private string $tipo;
    private float $valor;
    private ?string $subtipo;

    public function __construct(string $tipo, float $valor, ?string $subtipo = null)
    {
        $this->setTipo($tipo);
        $this->setValor($valor);
        $this->setSubtipo($subtipo);
    }

    public function getTipo(): string { return $this->tipo; }
    public function getValor(): float { return $this->valor; }
    public function getSubtipo(): ?string { return $this->subtipo; }

    public function setTipo(string $tipo): void
    {
        if (!in_array($tipo, ['transporte', 'energia', 'alimentacao']))
            throw new InvalidArgumentException("Tipo de emissão inválido.");
        $this->tipo = $tipo;
    }

    public function setValor(float $valor): void
    {
        if ($valor < 0) throw new InvalidArgumentException("Valor não pode ser negativo.");
        $this->valor = $valor;
    }

    public function setSubtipo(?string $subtipo): void { $this->subtipo = $subtipo; }

    public function calcularEmissao(): float
    {
        $emissaoMensal = match ($this->tipo) {
            'transporte'  => $this->calcularTransporte(),
            'energia'     => $this->calcularEnergia(),
            'alimentacao' => $this->calcularAlimentacao(),
            default       => 0
        };
        return $emissaoMensal * 12;
    }

    private function calcularTransporte(): float
    {
        $fatores = ['gasolina' => 0.192, 'diesel' => 0.171, 'etanol' => 0.150, 'eletrico' => 0.050];
        if (!isset($fatores[$this->subtipo]))
            throw new InvalidArgumentException("Subtipo de transporte inválido.");
        return $this->valor * $fatores[$this->subtipo];
    }

    private function calcularEnergia(): float { return $this->valor * 0.084; }

    private function calcularAlimentacao(): float
    {
        $fatores = ['carnivora' => 3.3 * 30, 'mista' => 2.5 * 30, 'vegetariana' => 1.7 * 30, 'vegana' => 1.5 * 30];
        if (!isset($fatores[$this->subtipo]))
            throw new InvalidArgumentException("Tipo de dieta inválido.");
        return $fatores[$this->subtipo];
    }
}

class CalculadoraCarbono
{
    private Pessoa $pessoa;
    private array $fontes = [];

    public function __construct(Pessoa $pessoa) { $this->pessoa = $pessoa; }

    public function adicionarFonte(FonteEmissao $fonte): void { $this->fontes[] = $fonte; }

    public function calcularTotal(): float
    {
        $total = 0;
        foreach ($this->fontes as $fonte) {
            $emissao = $fonte->calcularEmissao();
            if ($fonte->getTipo() === 'alimentacao')
                $emissao *= $this->pessoa->getFatorEstiloVida();
            $total += $emissao;
        }
        return $total;
    }
}

$resultado = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pessoa = new Pessoa(
            $_POST['nome'],
            (int)$_POST['idade'],
            $_POST['cidade'],
            (int)$_POST['numeroPessoas'],
            $_POST['estiloVida']
        );

        $calculadora = new CalculadoraCarbono($pessoa);

        $transporte = new FonteEmissao('transporte', (float)$_POST['km'], $_POST['combustivel']);
        $energia    = new FonteEmissao('energia', (float)$_POST['kwh'], null);
        $alimentacao = new FonteEmissao('alimentacao', 0, $_POST['dieta']);

        $calculadora->adicionarFonte($transporte);
        $calculadora->adicionarFonte($energia);
        $calculadora->adicionarFonte($alimentacao);

        $fontes = [$transporte, $energia, $alimentacao];
        $dadosTabela = [];

        foreach ($fontes as $fonte) {
            $emissao = $fonte->calcularEmissao();
            if ($fonte->getTipo() === 'alimentacao') {
                $emissao *= $pessoa->getFatorEstiloVida();
            }
            $dadosTabela[] = [
                'tipo'    => $fonte->getTipo(),
                'subtipo' => $fonte->getSubtipo(),
                'emissao' => number_format($emissao, 2)
            ];
        }

        $total = number_format($calculadora->calcularTotal(), 2);

        $resultado = [
            'pessoa'      => $pessoa,
            'dadosTabela' => $dadosTabela,
            'total'       => $total
        ];

    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>EcoCalc</title>
</head>
<body>

<div class="topo w3-bar">
    <span class="w3-bar-item w3-xlarge">EcoCalc</span>
    <a href="login.php" class="w3-bar-item w3-button w3-right">Entrar</a>
    <a href="cadastro.php" class="w3-bar-item w3-button w3-right">Cadastro</a>
</div>

<div class="w3-container w3-padding-64">
    <div class="w3-content card" style="max-width:800px">
        <h1 class="titulo">Calcule sua Pegada de Carbono</h1>
        <p>O EcoCalc calcula sua pegada de carbono com base no seu transporte e consumo de energia, mostrando seu impacto ambiental e sugestões para reduzir a poluição.</p>
        <br>

        <form method="POST">
            <h3>Dados Pessoais</h3>
            <input type="text" name="nome" placeholder="Nome" required><br>
            <input type="number" name="idade" placeholder="Idade" required><br>
            <input type="text" name="cidade" placeholder="Cidade" required><br>
            <input type="number" name="numeroPessoas" placeholder="Pessoas na residência" required><br>
            <select name="estiloVida">
                <option value="baixo">Baixo</option>
                <option value="medio">Médio</option>
                <option value="alto">Alto</option>
            </select><br>

            <h3>Transporte (km/mês)</h3>
            <input type="number" step="0.1" name="km" required><br>
            <select name="combustivel">
                <option value="gasolina">Gasolina</option>
                <option value="diesel">Diesel</option>
                <option value="etanol">Etanol</option>
                <option value="eletrico">Elétrico</option>
            </select><br>

            <h3>Energia (kWh/mês)</h3>
            <input type="number" step="0.1" name="kwh" required><br>

            <h3>Alimentação</h3>
            <select name="dieta">
                <option value="carnivora">Carnívora</option>
                <option value="mista">Mista</option>
                <option value="vegetariana">Vegetariana</option>
                <option value="vegana">Vegana</option>
            </select><br><br>

            <button type="submit" class="botao">Calcular</button>
        </form>

        <?php if (isset($erro)): ?>
            <p style="color:red"><?= $erro ?></p>
        <?php endif; ?>

        <?php if ($resultado): ?>
            <h3>Resumo do Usuário</h3>
            <p><?= $resultado['pessoa']->exibirResumo(); ?></p>

            <h3>Emissões por Fonte</h3>
            <table style="border-collapse:collapse;width:100%;margin-top:20px">
                <tr>
                    <th style="border:1px solid #ccc;padding:10px;background:#f4f4f4">Tipo</th>
                    <th style="border:1px solid #ccc;padding:10px;background:#f4f4f4">Subtipo</th>
                    <th style="border:1px solid #ccc;padding:10px;background:#f4f4f4">Emissão Anual (kg CO₂)</th>
                </tr>
                <?php foreach ($resultado['dadosTabela'] as $linha): ?>
                <tr>
                    <td style="border:1px solid #ccc;padding:10px;text-align:center"><?= $linha['tipo'] ?></td>
                    <td style="border:1px solid #ccc;padding:10px;text-align:center"><?= $linha['subtipo'] ?? '-' ?></td>
                    <td style="border:1px solid #ccc;padding:10px;text-align:center"><?= $linha['emissao'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <p style="font-weight:bold;font-size:18px;margin-top:20px">Total Anual: <?= $resultado['total'] ?> kg CO₂</p>
        <?php endif; ?>
    </div>
</div>

<div class="w3-container w3-content w3-padding-32" style="max-width:1000px">
    <div class="w3-row-padding">
        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Responda</h3>
                <p>Preencha o questionário sobre transporte e energia.</p>
            </div>
        </div>
        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Calculamos</h3>
                <p>Calculamos sua emissão de CO₂.</p>
            </div>
        </div>
        <div class="w3-third">
            <div class="card">
                <h3 class="titulo">Resultado</h3>
                <p>Veja gráficos e dicas para reduzir sua pegada.</p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
