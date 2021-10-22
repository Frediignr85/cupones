<?php
$session = session();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">


    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />

    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

    <!-- Carousel -->
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css" />
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.theme.min.css" />

    <!-- Animate On Scroll -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />


    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="<?php echo base_url("/assets/css/styles.css"); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
    <title>Phone Shop</title>
</head>

<body>
    <header id="header" class="header">
        <div class="navigation">
            <div class="container">
                <nav class="nav">
                <div class="nav__hamburger">
                        <svg>
                            <use xlink:href="<?php echo base_url("images/sprite.svg#icon-arrow-up"); ?>"></use>
                        </svg>
                    </div>

                    <div class="nav__logo">
                        <a href="/" class="scroll-link">
                            UIS
                        </a>
                    </div>

                    <div class="nav__menu">
                        <div class="menu__top">
                            <span class="nav__category">PHONE</span>
                            <a href="#" class="close__toggle">
                                <svg>
                                    <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-cross"); ?>">
                                    </use>
                                </svg>
                            </a>
                        </div>
                        <ul class="nav__list">
                            <li class="nav__item">
                                <a href="#header" class="nav__link scroll-link">Inicio</a>
                            </li>
                        </ul>
                    </div>
                    <?php
                    if(is_numeric($session->get('id_usuario'))){
                        ?>
                    <div class="nav__icons">
                        

                        <a href="carrito" class="icon__item">
                            <svg class="icon__cart">
                                <use
                                    xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-shopping-basket"); ?>">
                                </use>
                            </svg>
                            <span id="cart__total"></span>
                        </a>

                    </div>
                    <?php
                    }

                    ?>

                    <?php
                        
                        if(!isset($_SESSION['id_cliente']) || $session->get('id_cliente') == 0){
                    ?>
                            <a class="opciones_login" href="login">
                                Login
                            </a>
                    <?php
                        }
                        else{
                            $nombre = $session->get('nombre');
                            $array = explode(" ",$nombre);
                            $nombre_cliente = $array[0]." ".$array[1];
                    ?>
                        <p  class="opciones_login">BIENVENIDO: <b><?php echo $nombre_cliente; ?></b></p>
                        <a class="opciones_login" href="logout">
                                Salir
                            </a>
                    <?php
                        }
                    ?>
                </nav>
            </div>
        </div>

        <div class="page__title-area">
            <div class="container">
                <div class="page__title-container">
                    <ul class="page__titles">
                        <li>
                            <a href="/">
                                <svg>
                                    <use xlink:href="./images/sprite.svg#icon-home"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="page__title">Pago</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main id="main">
        <section class="section cart__area">
            <?php echo $result; ?>
        </section>

        <!-- Facility Section -->
        <section class="facility__section section" id="facility">
            <div class="container">
                <div class="facility__contianer">
                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-airplane"); ?>">
                                </use>
                            </svg>
                        </div>
                        <p>ENVIO A TODO EL MUNDO</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use
                                    xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-credit-card-alt"); ?>">
                                </use>
                            </svg>
                        </div>
                        <p>GARANTIA DE DEVOLUCION DEL 100%</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-credit-card"); ?>">
                                </use>
                            </svg>
                        </div>
                        <p>MUCHAS FORMAS DE PAGO</p>
                    </div>

                    <div class="facility__box">
                        <div class="facility-img__container">
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-headphones"); ?>">
                                </use>
                            </svg>
                        </div>
                        <p>SOPORTE 24/7</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="footer" class="section footer">
        <div class="container">
            <div class="footer__top">
                <div class="footer-top__box">
                    <h3>INFORMACION</h3>
                    <a href="#">Acerca de Nosotros</a>
                    <a href="#">Politicas de privacidad</a>
                    <a href="#">Terminos y Condiciones</a>
                    <a href="#">Contactanos</a>
                    <a href="#">Mapa</a>
                </div>
                <div class="footer-top__box">
                    <h3>MI CUENTA</h3>
                    <a href="#">Mi cuenta</a>
                    <a href="#">Historial de Compras</a>
                    <a href="#">Carrito</a>
                </div>
                <div class="footer-top__box">
                    <h3>CONTACTANOS</h3>
                    <div>
                        <span>
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-location"); ?>">
                                </use>
                            </svg>
                        </span>
                        San Miguel, San Miguel
                    </div>
                    <div>
                        <span>
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-envelop"); ?>">
                                </use>
                            </svg>
                        </span>
                        soporte@web-uis.com
                    </div>
                    <div>
                        <span>
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-phone"); ?>"></use>
                            </svg>
                        </span>
                        +(503) 7691-7693
                    </div>
                    <div>
                        <span>
                            <svg>
                                <use xlink:href="<?php echo base_url("assets/images/sprite.svg#icon-paperplane"); ?>">
                                </use>
                            </svg>
                        </span>
                        San Miguel, El Salvador
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="footer__bottom">
            <div class="footer-bottom__box">

            </div>
            <div class="footer-bottom__box">

            </div>
        </div>
        </div>
    </footer>

    <!-- End Footer -->

    <!-- Go To -->

    <a href="#header" class="goto-top scroll-link">
        <svg>
            <use xlink:href="<?php echo base_url("/assets/images/sprite.svg#icon-arrow-up") ?>"></use>
        </svg>
    </a>
    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(""); ?>">

<!-- Glide Carousel Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Glide Carousel Script -->
    <script src="node_modules/@glidejs/glide/dist/glide.min.js"></script>

    <!-- Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JavaScript -->
    <script src="<?php echo base_url("/assets/js/products.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/js/index.js") ?>"></script>
    <script src="<?php echo base_url("/assets/js/slider.js") ?>"></script>
    <script src="<?php echo base_url("/assets/js/pago.js") ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>