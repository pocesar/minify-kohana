For Kohana 3.2, use the 3.2 branch, the only thing that changes is the case on the filenames

It's a Minify module based on the best minifier for PHP imho > https://github.com/mrclay/minify
Extract the contents to 'modules' folder, enable it in the bootstrap:

```html
  Kohana::modules(array(
    'minify' => MODPATH.'minify', // Minify
  ));
```

and the only thing you need to do actually, is to create a subfolder on 'application/cache' called minify, and you're ready to go (otherwise you'll get problems with the file cache).
Call it in your HTML files like:

```html
  <link href="/min?f=file1.css,file2.css,file3.css&b=/css/" rel="stylesheet">
```

#### Don't forget to copy the file `modules/minify/config/minify.php` to your applications folder in `application/config/minify.php`
##### Don't make modifications inside the modules folder

It's already configured with a route called minify, that maps to '/min', and if you don't want to output what is your js or
css folder, you can use groups, by specifying it in your `/application/config/minify.php` file:

### in PHP:

```php
  return array(
    'groupsConfig' => array(
      'css' => array('//css/file1.css', '//css/file2.css', '//css/file3.css'),
      'js' => array('//js/jquery.js', '//js/modernizr.js', '//js/plugin/orbit.js')
    )
  );
```

### in HTML:

```html
<link href="/min?g=css" rel="stylesheet">
```

### You may call groups like:

```html
<link href="/min/css" rel="stylesheet">
```

### Kohana style:

```html
<?php echo html::style('min?g=css') // or html::style('min/css') ?>
```

### Debugging

Append `?debug=1` to your `min/` URL, it will show you what's going on in your file.

Have fun!