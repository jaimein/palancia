<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<head>
    <meta charset="UTF-8">
    <title>Fiestas Palancia</title>
    <script type="../text/JavaScript" src="js/sha512.js"></script>
    <script type="../text/JavaScript" src="js/forms.js"></script>
    <link media="all" href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/formcss.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <img src="img/logo.jpg" width="75%" alt="logo"></img>
            </div>
            <div id="title">
                Fiestas Palancia
            </div>
        </div>
        <div id="content">
            <?php
            include('controlador.php'); //y ahora mostramos la pagina llamada                      
            ?>
        </div>
        <div id="footer">
            <div id="subtitle">
                <a href="../index.php"> Fiestas Palancia </a>
            </div>
        </div>
    </div>
</body>

</html>