<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firefly-PHP Documentation</title>
    <style type="text/css">
        
        
        
        
    </style>
  </head>
  <body>
    <h1>Firefly-PHP Documentation</h1>
    <hr>
    <h2>About</h2>
    <pre>
      A simple and smallweight path routing framework to build any kind of web application. Its Plugin/Helper based so easy to enlarge functionality.
    </pre>
    <hr>
    <h2>Getting started</h2>
    <pre>
      1. Clone the current version of firefly-php from https://github.com/singhtreehouse/firefly-php.git .
      2. Change the <b>app/config.php</b> for your needs.
      3. Check out the example controller <b>app/controller/index/index.php</b>
      4. Check out the example plugin <b>app/controller/index/index.php</b>
      5. Begin develop .) for further information check the following topics or mail me (singh@devilcode.org) .
    </pre>
    <hr>
    <h2>File-Structure</h2>
    <pre>
      <b>- public/</b>
      The public directory includes all your public direct accessable files. Its meant to be your document root.
      
      
      <b>- app/</b>
      The application path includes all business logic of your webapplication. Since <b>public/</b> is meant to be your
      document root , the <b>app/*</b> can't be called directly and ensures that you cant produce bugs/security flaws to
      single call files out of their context. The <b>app/</b> directory includes the following files[f]/directories[d]:
      
      [f] <b>bootstrap.php</b>
      [f] <b>config.php</b>
      [f] <b>models.php</b>
      [f] <b>router.php</b>
      [d] <b>controller/</b>
      [d] <b>helper/</b>
      [d] <b>plugins/</b>
      [d] <b>storage/</b>
      
      
      <b>- app/controller/</b>
      The controller directory basicly includes your business logic , build up in a structure like:
      <b>app/controller/{YOUR_CONTROLLER_NAME}/{YOUR_CONTROLLER_NAME}.php</b>
      
      
      <b>- app/helper/</b>
      The helper directory basicly includes all your snippets you use on multiplace controller/plugins.
      The structure is build up like:
      <b>app/helper/{YOUR_HELPER_NAME}/{YOUR_HELPER_NAME}.php</b>
      
      
      <b>- app/plugins/</b>
      The plugins directory basicly includes your frontend plugin logic , build up in a structure like:
      <b>app/plugins/{YOUR_PLUGIN_NAME}/{YOUR_PLUGIN_NAME}.php</b>
      
      
      <b>- app/storage/</b>
      The storage directory is compareable to the upload/ or data/ directory. Its a storage directory for
      any type of ressources. Since it is outside the document root you can place even sensitive files into
      it.
      
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
    <hr>
    <h2></h2>
    <pre>
        
    </pre>
  </body>
</html>
