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
    function admin_url( $path = 'html/wp-content/plugins/wordpressProject/form.php', $scheme = 'admin' ) {
      return get_admin_url( null, $path, $scheme );
   }
   error_log(admin_url())

   // function admin_url2() {
   //    return 'holiiiiiii';
   // };
   // error_log(admin_url2())

    ?>   
 </body>
</html>
