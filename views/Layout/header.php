
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <title>Tienda De Camisetas</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/style.css"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <body>

        <div id="container">
            
        <!---CABECERA--->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta Logo"/>
                <a href="<?=base_url?>">
                    Tienda de camisetas
                </a>
            </div>
        </header>
        <!--MENU---->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                <a href="<?=base_url?>">Inicio</a>
                </li>

                <?php while($cat = $categorias->fetch_object()): ?>
                <li>
                <a href="<?=base_url?>Categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </nav>

         <div id="content">
            