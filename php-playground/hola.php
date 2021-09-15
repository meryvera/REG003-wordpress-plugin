<html>
 <head>
  <title>Prueba de PHP</title>
 </head>
 <body>
 <?php echo '<p>Hola MundOOOooooo</p>'; 
    define('myForm', __FILE__);
    error_log('myForm');
    // echo('myForm');
    $sql='soy meryyyyyy ';
    error_log($sql);

    $myForm2= __FILE__;
    error_log($myForm2);

    $myForm3= __DIR__;
    error_log($myForm3);

    $path = getcwd();
    echo $path;
    error_log($path);
    //error_log($path .'/hola.php');
    ?>   
 </body>
</html>
