<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- utilização do w3.css e css -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="estilo.css">
    <!-- fonte das letras -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <title>Sobre o EcoCalc</title>
</head>
<body>

  <div class="topo w3-bar">
    <a href="paginainicial.php" class="w3-bar-item w3-xlarge" style="text-decoration:none;">
    EcoCalc </a>
    <label for="afmenu" class="w3-bar-item w3-button w3-right">
    <i class="fa fa-bars"></i>
    </label>
    <input type="checkbox" id="afmenu" hidden>

    <div class="overlay"></div>

  <!-- menu lateral -->
    <nav class="menu">
    <label for="afmenu" class="fechar">
    <i class="fa fa-bars"></i>
    </label>
    <a href="conta.php" class="w3-bar-item w3-button">Minha Conta</a>
    <a href="historico.php" class="w3-bar-item w3-button">Histórico</a>
    <a href="configuracoes.php" class="w3-bar-item w3-button">Configurações</a>
    <a href="sobre.php" class="w3-bar-item w3-button">Sobre</a>
  </nav>
  </div>

  <div class="w3-container w3-padding-64">
    <div class="w3-content card" style="max-width:900px">

      <h1 class="titulo">Sobre o Projeto</h1>
      <p>
        O <strong>EcoCalc</strong> é uma aplicação web desenvolvida para estimar a 
        pegada de carbono pessoal dos usuários, considerando hábitos de transporte 
        e consumo de energia doméstica.
      </p>
      <p>
        A ferramenta utiliza um questionário segmentado, cálculos automatizados e 
        gráficos interativos para apresentar os resultados. Além disso, oferece 
        recomendações práticas e personalizadas para ajudar na redução das emissões.
      </p>
      <p>
        Como resultado, o EcoCalc se apresenta como uma solução educativa e prática, 
        capaz de apoiar indivíduos e comunidades na adoção de comportamentos mais 
        sustentáveis e alinhados às metas globais de mitigação das mudanças climáticas.
      </p>
</div>

<!-- Justificativa -->
      <div class="w3-content card" style="max-width:900px">
      <h1 class="titulo">Justificativa</h1>
      
      <p>
      O desenvolvimento do EcoCalc surge da necessidade urgente de ampliar a consciência ambiental 
      da população. Apesar do crescente interesse por práticas sustentáveis, muitas pessoas ainda não
      têm clareza sobre o impacto real de seus hábitos cotidianos, especialmente no transporte e no consumo
      de energia doméstica. A ausência de ferramentas acessíveis e interativas que permitam calcular e compreender
      a própria pegada de carbono dificulta a adoção de comportamentos mais responsáveis.
      </p>


      <p>
        Mesmo quando existe consciência sobre os problemas ambientais, 
        os usuários frequentemente não sabem quais ações práticas podem tomar 
        para reduzir suas emissões de forma eficaz e personalizada. Nesse contexto, 
        o EcoCalc busca preencher essa lacuna ao traduzir hábitos cotidianos em um 
        número compreensível — a pegada de carbono — capacitando o usuário a visualizar 
        seu impacto e identificar caminhos acessíveis para reduzi-lo.

      </p>


      <p>
        Além disso, o projeto reforça que a transição para uma sociedade de baixo carbono 
        depende não apenas de políticas públicas, mas também da educação e do engajamento 
        individual. Assim, o EcoCalc se apresenta como uma ferramenta educativa e prática, 
        capaz de apoiar indivíduos e comunidades na adoção de comportamentos mais sustentáveis 
        e alinhados às metas globais de mitigação das mudanças climáticas.

      </p>


    </div>


  <div class="w3-content card" style="max-width:900px">

      <h1 class="titulo"> Desenvolvedores</h1>
      <p>
        Anna Julya Rodrigues Praça
      </p>
      
      <p>
        Guilherme Martinelli Francisco
      </p>

      <p>
        Guilherme Silva Ribeiro
      </p>

      <p>
        Kelly Cristina Alexandre Rodrigues
      </p>

      <p>
        Marcelo Ferreira Amorim Junior
      </p>

      
    </div>
</div>

</body>
</html>
