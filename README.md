It's a Minify module (has been heavily modified to fit kohana auto-loading style, structure and code wise) based on the best minifier for PHP imho > http://code.google.com/p/minify/
Extract the contents to 'modules' folder, enable it in the bootstrap:

    Kohana::modules(array(
      'minify' => MODPATH.'minify', // Minify
    ));

and the only thing you need to do actually, is to create a subfolder on 'application/cache' called minify, and you're ready to go (otherwise you'll get problems with the file cache).
Call it in your HTML files like:

    <link href="/min?f=file1.css,file2.css,file3.css&b=/css/" rel="stylesheet">
    
it's already configured with a route called minify, that maps to '/min', and if you don't want to output what is your js or css folder, you can use groups, by specifying it in your /application/config/minify.php file:

### in PHP:
    return array(
       'groupsConfig' => array(
           'css' => array('//css/file1.css', '//css/file2.css', '//css/file3.css')
       )
    );

### in HTML:
    <link href="/min?g=css" rel="stylesheet">

### Kohana style:
    <?php echo html::style('min?g=css') ?>

Have fun!