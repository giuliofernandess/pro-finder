<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProFinder</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" rel="stylesheet" />
    <link href="css/index.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
</head>

<body onload="adaptLogin()" onresize="adaptLogin()">

    <!-- Cabeçalho -->
    <header>

        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-dark d-flex flex-column align-items-start">
            <div class="container-fluid p-0">
                <a class="navbar-brand" href="#"><img src="images/logo.png" alt="Logo ProFinder"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="professionals.php">Profissionais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="support.php">Suporte</a>
                        </li>

                        <?php

                        session_start();

                        if (isset($_SESSION['email'])) {
                            echo '<li class="nav-item" id="loginText">
                                <a class="nav-link" href="profile.php">Perfil</a>
                            </li>
                        </ul>
                    </div>
                    <span class="navbar-text" id="loginImage">
                        <a href="profile.php"><img src="images/icon-person.png" alt="Ícone Login"></a>
                    </span>';
                        } else {
                            echo '<li class="nav-item" id="loginText">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        </ul>
                    </div>
                    <span class="navbar-text" id="loginImage">
                        <a href="login.php"><img src="images/icon-person.png" alt="Ícone Login"></a>
                    </span>';
                        }

                        ?>

                </div>

                <!-- Modal -->
                <div class="container-fluid d-flex flex-column align-items-start modal-container p-0">
                    <h1 class="head title">Conecte-se com os melhores profissionais</h1>
                    <p class="head-paragraph">Encontre especialistas em saúde, tecnologia, educação, e muito mais</p>
                    <a href="professionals.php"><button type="button" class="btn btn-primary btn-lg">Explorar Agora</button></a>
                </div>
        </nav>

    </header>

    <!-- Corpo da Página-->
    <main>
        <!-- Cards dos Profissionais -->

        <div class="container container-cards py-4">
            <h5 class="mb-4 fw-semibold">Profissionais Destaques</h5>
            <div class="row g-3">
                <?php
                    $connect = mysqli_connect("localhost", "root", "", "pro-finder");

                    $sql = "SELECT professional.profession, accounts.name, accounts.profile_image, professional.id_professional FROM professional INNER JOIN accounts ON professional.id_professional = accounts.id_professional LIMIT 4";

                    $result = $connect->query($sql);
                    
                    while ($res = $result->fetch_array()) {
                
                        $id_professional = $res['id_professional'];
                ?>
                    <div class="col-12 col-md-6">
                        <form method="post" action="professionalProfile.php" class="card card-custom p-3 d-flex flex-row align-items-center">
                            <?php if (empty($res['profile_image'])): ?>
                                <img src="images/anonymous-user.jpg" alt="Foto de Perfil" class="profile-img me-3">
                            <?php else: ?>
                                <img src="images/profile-images/<?php echo $res['profile_image'] ?>" alt="img" class="profile-img me-3">
                            <?php endif; ?>
                            <div class="flex-grow-1">
                                <input type="hidden" name="id_professional" value="<?php echo $id_professional ?>">
                                <strong><?php echo $res['name'] ?></strong><br>
                                <div class="city"><?php 
                                
                                $sql = "SELECT `name` FROM `city` WHERE `id` = (SELECT `city` FROM `accounts` WHERE `id_professional` = $id_professional)";

                                echo $connect->query($sql)->fetch_array()['name'];
                                ?></div>
                                <small><?php echo $res['profession'] ?></small>
                            </div>
                                <?php 
                                
                                if (isset($_SESSION['email'])) { ?>
                                     <button class="btn btnSeeProfile">Ver Perfil</button>
                                <?php } else { ?>
                                     <a href="login.php" class="btn btnSeeProfile">Ver Perfil</a>
                                <?php } ?>
                                 
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!--Cards das Areas-->

        <div class="container my-5">
            <h5 class="mb-4 fw-semibold">Explore por Categoria</h5>
            <div class="row text-center justify-content-center g-4">
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <p class="mt-2 mb-0">Saúde</p>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <p class="mt-2 mb-0">Tecnologia</p>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-bank"></i>
                    </div>
                    <p class="mt-2 mb-0">Jurídico</p>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-brush"></i>
                    </div>
                    <p class="mt-2 mb-0">Design</p>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-mortarboard"></i>
                    </div>
                    <p class="mt-2 mb-0">Educação</p>
                </div>
                <div class="col-6 col-sm-4 col-md-2">
                    <div class="icon-category">
                        <i class="bi bi-hammer"></i>
                    </div>
                    <p class="mt-2 mb-0">Construção</p>
                </div>
            </div>
        </div>

        <!--Fim dos cards de areas-->
    

        <!--Depoimentos-->
        <div class="depoiments">
            <div class="container py-5 my-5" style="margin-bottom: 200px;">
                <h2 class="text-center mb-4 fw-bold fonte">O que dizem nossos usuários? </h2>
                <div class="row g-4 justify-content-center">


                    <!--1 Depoimento-->
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-2">
                                <img src="images/anonymous-user.jpg" alt="img" class="profile-img me-3">
                                <div>
                                    <p class="user-info mb-0">Nayara</p>
                                </div>
                            </div>
                            <div class="testimonial-stars mb-2">★★★★★</div>
                            <p>A ProFinder foi além do esperado! Fui atendido com atenção do início ao fim, e o resultado
                                final foi incrível. Dá pra ver que realmente se importam com a qualidade e com o
                                cliente.</p>
                        </div>
                    </div>


                    <!--2 Depoimento-->
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-2">
                                <img src="images/anonymous-user.jpg" alt="img" class="profile-img me-3">
                                <div>
                                    <p class="user-info mb-0">Andressa</p>
                                </div>
                            </div>
                            <div class="testimonial-stars mb-2">★★★★★</div>
                            <p>A experiência superou minhas expectativas e me deixou totalmente confiante em continuar
                                contando com os serviços da empresa. Recomendo sem hesitar! </p>
                        </div>
                    </div>


                    <!--3 Depoimento-->
                    <div class="col-md-6 col-lg-4">
                        <div class="testimonial-card">
                            <div class="d-flex align-items-center mb-2">
                                <img src="images/anonymous-user.jpg" alt="img" class="profile-img me-3">
                                <div>
                                    <p class="user-info mb-0">Juliana</p>
                                </div>
                            </div>
                            <div class="testimonial-stars mb-2">★★★★★</div>
                            <p>Excelente experiência! Profissionais qualificados, atendimento rápido e soluções
                                personalizadas. Recomendo de olhos fechados para quem busca um serviço de confiança.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--fim depoimentos-->

        <!--Convite-->
        <div class="invitation">
            <div class="image-section">
                <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=80"
                    alt="Profissional" />
            </div>
            <div class="text-section">
                <h2>Seja reconhecido como profissional</h2>
                <p>
                    Quer divulgar seu trabalho ou oferecer seus serviços para quem precisa? Cadastre-se agora no nosso
                    site e tenha um perfil profissional em destaque na nossa plataforma. Alcance mais pessoas e
                    transforme sua carreira!
                </p>
                <a href="register.php" class="cta-button">Cadastre-se e seja encontrado</a>
            </div>
        </div>

        <!-- FAQ  -->
        <div class="section-faq mt-2 pt-5">
            <h2 class="title-faq fw-bold">Perguntas Frequentes</h2>

            <div class="accordion" id="acordeon-faq">

                <!-- 1 Pergunta -->
                <div class="accordion-item item-faq">
                    <h2 class="accordion-header" id="cabecalho1">
                        <button class="accordion-button button-faq collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#resposta1" aria-expanded="false" aria-controls="resposta1">
                            Como entrar em contato com um profissional na ProFinder?
                        </button>
                    </h2>
                    <div id="resposta1" class="accordion-collapse collapse" data-bs-parent="#acordeon-faq">
                        <div class="accordion-body response-faq">
                            No momento, o contato direto via chat na plataforma não está disponível. Porém,
                            disponibilizamos links alternativos em seus perfis para a comunicação entre clientes e
                            profissionais.
                        </div>
                    </div>
                </div>

                <!-- 2 Pergunta -->
                <div class="accordion-item item-faq">
                    <h2 class="accordion-header" id="cabecalho2">
                        <button class="accordion-button button-faq collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#resposta2" aria-expanded="false" aria-controls="resposta2">
                            Como encontro o profissional ideal para o meu problema?
                        </button>
                    </h2>
                    <div id="resposta2" class="accordion-collapse collapse" data-bs-parent="#acordeon-faq">
                        <div class="accordion-body response-faq">
                            Na ProFinder, você pode navegar pelas categorias ou usar a busca para filtrar profissionais
                            com base em suas necessidades específicas.
                        </div>
                    </div>
                </div>

                <!-- 3 Pergunta -->
                <div class="accordion-item item-faq">
                    <h2 class="accordion-header" id="cabecalho3">
                        <button class="accordion-button button-faq collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#resposta3" aria-expanded="false" aria-controls="resposta3">
                            Como garantir a qualidade dos profissionais na ProFinder?
                        </button>
                    </h2>
                    <div id="resposta3" class="accordion-collapse collapse" data-bs-parent="#acordeon-faq">
                        <div class="accordion-body response-faq">
                            Selecionamos cuidadosamente os profissionais cadastrados e avaliamos seus portfólios para
                            assegurar que ofereçam serviços de qualidade. Nosso objetivo é manter a confiança e
                            satisfação dos clientes.
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>

    <!-- Rodapé -->
    <footer>
        <div class="social-media-icons">
            <span class="icon-instagram"><a href="#"><img src="images/footer/icon-instagram.png"
                        alt="Icon Instagram"></a></span>
            <span class="icon-tiktok"><a href="#"><img src="images/footer/icon-tiktok.png" alt="Icon Tiktok"></a></span>
            <span class="icon-twitter-x"><a href="#"><img src="images/footer/icon-x.png" alt="Icon X"></a></span>
        </div>
        <div class="small">Info - Suporte - Marketing</div>
        <div class="small">Termos de uso - Política de Privacidade</div>
        <div class="small">© 2025 ProFinder</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
        </script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Funções JavaScript -->
    <script src="scripts/adaptLogin.js"></script>
</body>

</html>