    

# Firefly-PHP Documentation

## About

A simple and smallweight path routing framework to build any kind of web application. Its Plugin/Helper based so easy to enlarge functionality

## Getting started

  1. Clone the current version of firefly-php from https://github.com/singhtreehouse/firefly-php.git .
  2. Change the **app/config.php** for your needs.
  3. Check out the example controller **app/controller/index/index.php**
  4. Check out the example plugin **app/controller/index/index.php**
  5. Begin develop .) for further information check the following topics or mail me (singh@devilcode.org) 

## File-Structure

This part contains a simple overview over our file structure. For further information just scroll down.

**- public/**
The public directory includes all your public direct accessable files. Its meant to be your document root.

**- app/**
The application path includes all business logic of your webapplication. Since **public/** is meant to be your
document root , the **app/*** can't be called directly and ensures that you cant produce bugs/security flaws to
single call files out of their context. The **app/** directory includes the following files[f]/directories[d]:

[f] **bootstrap.php**
[f] **config.php**
[f] **models.php**
[f] **router.php**
[d] **controller/**
[d] **helper/**
[f] **helper/instance.php**
[d] **plugins/**
[d] **storage/**

**- app/controller/**
The controller directory basicly includes your business logic , build up in a structure like:
```php
app/controller/{YOUR_CONTROLLER_NAME}/{YOUR_CONTROLLER_NAME}.php
```

**- app/helper/**
The helper directory basicly includes all your snippets you use on multiple controller/plugins and
the **instance.php** wich is needed to use your helper.
The structure is build up like:
```php
app/helper/instance.php**
app/helper/{YOUR_HELPER_NAME}/{YOUR_HELPER_NAME}.php
```

**- app/plugins/**
The plugins directory basicly includes your frontend plugin logic , build up in a structure like:
```php
app/plugins/{YOUR_PLUGIN_NAME}/{YOUR_PLUGIN_NAME}.php
```

**- app/storage/**
The storage directory is compareable to the **upload/** or **data/** directory. Its a storage directory for
any type of ressources. Since it is outside the document root you can place even sensitive files into
it.

## config.php

The **config.php** contains all basic needed system configurations. This includes the base_href ,directory
paths, database login data , etc.

If you want to add other data into configuration simply place a call like the following pattern into your **config.php**

```php
config::set("{name}","{value}");
```

Since the config is handled within a static class its global accessable and you can get all config data just using
the following pattern:

```php
config::get("{name}");
```

PS: If you enable the debug mode (```php conf::set("debug",true)```) the logger will log **info** and **warnings** too.
    On default (debug = false) it will only log errors.

## bootstrap php

The **bootstrap.php** contains some calls to setup the system and the registration of callable paths.

This includes the following:

  - Startup Session              // can be removed if unnecessary
  - Setup Database Connection    // can be removed if not database usage needed
  - Init params class/modell     // system requirement, further explaination at section **models.php**
  - Register callable routes     // system requirement, further explaination at section **models.php**
  - Get the actual called route  // system requirement, further explaination at section **models.php**
  - Init Logger                  // system requirement, further explaination at section **models.php**

If you need any preprocessing before the framework handles your call via plugin/controller , you can place
it at the end of bootstrap.php. You should be able to call all helpers and access needed paths but are still
before the execution of your business logic.

## models.php

This file contains system required models/classes. I will explain them one for one in the following:

**conf**

  The configuration model/class simply is a static class to be filled with global accessable data.
  It contains two methods, a getter and a setter. Since the class is build up static all calls
  will access the same object.

  The calls are simple as following:

  **Setter**
  ```php
  conf::set("{name}","{value}")
  ```

  **Getter**
  ```php
  conf::get("{name}")
  ```

**params**

  The params model/class is build for a better input parameter usage. It allows you to access
  $_REQUEST , $_GET , $_POST via a simple call, and implements some santitations. It is inited
  inside the bootstrap.php. The usage is simple as following:

  ```php
  params::get("{name}")                         // returns $_REQUEST["{name}"] or false
  params::get("{name}","{type}")                // returns $_{type}["{name}"] or false. Allowed types are get and post
  params::get("{name}","{type}","{sanitation}") // returns $_{type}["{name}"] after using {santitation} or false.
  ```

**depends**

  The depends model/class is used for dependency management. This means if you are coding a **controller**, **plugin**
  or **helper** wich has a dependency to another of this, or simply makes no sense without one of those specific, you should
  add a dependency into your file. This is really simple. Just add at the top of your file a call like the following pattern.

  ```php
  depends::on(array("{type}:{name}")) // Example depends::on{array("helper:paths")}
  ```

  Allowed Types are as following : **helper** , **controller** , **plugin**

  When the file gets required it will auto check if the dependency is given, if not it will log down an error and stop the
  process informing you about the missing dependency. Its important to conscientious add those to hav a valid and consistent
  development.

**route**

  The route model/class is static and used ro register callable routes same as the system uses it to find out wich
  **controller**/**plugin** to load at a call. The call to get the actual route is inside the bootstrap.php
  below the **route::add** calls. This is important! Dont place ```php route::add ``` calls below the ```php route::getRoute ```
  or they gonne be ignored.

  An simple example for an **route::add** call looks like following:

  ```php
  route::add(array("path"       => "test",
                   "controller" => "foo",
                   "plugin"     => "bar"));**
  ```

  To explain what you just did by registering this path.

  If a user calls **yourdomain.tld/test.html** , in wich **"test"** is the just registered path, the system will init
  the **plugin** **"bar"** givin it a new instancen of **controller** **"foo"**. Like this you register all
  your callable paths.

  A path can be displayd as too types , shown as following:
  - yourdomain.tld/test.html
  - yourdomain.tld/test/

  We decided to hav this handling to easy allow writing website-like applications same as f.e. REST-Apis. 

  **Important!** - To catch/register the calls on **yourdomain.tld/** , so the **index** calls you need to register
  the **"index"** path. The system will auto-use the index path on docroot calls without further path params.

**log**

  The log model/class is a simple logger class. On default it only logs errors, bug if you change the config flag **"debug"** on **"true"**
  it will log **info** and **warning** too .It contains 3 public methods to be called. These are:

  ```php
  log::info("{msg}")         // To log simple informations , gud for debugging
  log::warning("{msg}")      // To log semi critical informations 
  log::error("{msg}")        // To log critical errors, these will be loged even if conf-debug = false;
  ```

## router.php

The router.php basicly is the core class of our system. It will be inited inside the **public/index.php**. It basicly contains
the **bootstrap.php** call and initiates the **controller** and **plugin** that are needed for the called path. On
call it generates a new instance of the registered **plugin** and gives it a new instance of the registered **controller**
as __construct() param.

## instance.php

The instance file includes a static class to get instances of your helpers. Its meant as basic for the helpers. It consists
of two public callable methods:

```php
helper::getInstance("{helper_to_call}")        //returns a instance of {helper_to_call} wich will be cached and redelivered on same call
helper::getSingleInstance("{helper_to_call}")  //returns a non-cached instance of {helper_to_call} that can be used in its own context
```

## Plugins

Plugins , or better said frontend plugins are meant to decide what output handling should be used on the data that your **controller** provides.
It will be inited inside the router and presented to the **controller** as __construct() param. You can change its build-up free since the
methods just must be standardized to be usefull for all **controllers**.

To create a new plugin you hav to create it like the following explaination.

In our example we gonne create the plugin **"frontend"**.

1. Create the plugin directory
   - **app/plugins/frontend/**

2. Place the controller PHP-file inside the directory with the same name
   - **app/plugins/frontend/frontend.php**

3. Create a class inside the file you just created at 2. and fill it with a class
   that has the same name like your plugin , in this example
   - ```php class frontend {.....} ```

Now you just hav to register the **plugin** inside the bootstrap.php onto the path you wanne use it. So you simply can write f.e
a plugin for. Some simple examples:

  - **frontend**    //basic html output
  - **api**         //REST api or others
  - **admin**       //backend that checks login state inside the plugin

## Controller

The controller contains your main business logic. You can build it up completly free, besides the fact you need a __construct()
method that inits the processing including it must accept **plugin**-instance as __construct param.

To create a new controller you hav to create it like the following explaination.

In our example we gonne create the controller **"index"**.

1. Create the controller directory
   - **app/controller/index/**

2. Place the controller PHP-file inside the directory with the same name
   - **app/controller/index/index.php**

3. Create a class inside the file you just created at 2. and fill it with a class
   that has the same name like your controller , in this example
   - ```php class index {.....} ```

4. Make the __construct function of the class you just created at 3. accept an
   object/instance of the registerd **plugin**.

In case you have a plugin that needs no further controller code, just create an empty controller that only handles the plugin basic
output calls and register it to the path you.

## Helper

The helpers are meant to contain code that is used on multiple places. Like in multiple controllers , multiple plugins or simply
other helpers.

To call a helper you got two different public methods given by **instance.php**

1. ```php helper::getInstance("{name}"); ```
  - This will return an instance of the helper {name}. If the helper allready got called once, it will return a static cached object.
    This is usefull if you dont need a single instance for every call , or even if you need especially the same object again like
    a database class including the connection.

2. ```php helper::getSingleInstance("{name}"); ```
  - This will return an instance of the helper {name}. The difference to helper::getInstance("{name}") simply is that you will recieve
    a new instance of the helper {"name"} instead of a cached one.

To create a new helper you hav to create it like the following explaination.

In our example we gonne create the helper **"upload"**.

1. Create the helper directory
   - **app/helper/upload/**

2. Place the controller PHP-file inside the directory with the same name
   - **app/helper/upload/upload.php**

3. Create a class inside the file you just created at 2. and fill it with a class
   that has the same name like your helper , in this example
   - **class upload {.....}**

**System basic helpers**

  **paths**

  The Paths helper is a basic system helper (means its shipped with the basic version of firefly-php) and its required for the system to work.
  it's usage is quite simple and really usefull for every development with firefly-php. Since we hav registered all system paths inside the
  **config.php** the paths helper provides a simple method of getting those paths.

  To get a path via the paths helper use the following pattern:
  - **helper::getInstance("paths")->get("{pathname}")**     // for example helper::getInstance("paths")->("storage")

  All paths you add inside the config.php using the same naming pattern like the system basic paths can be looked up via the
  paths helper.

    **Important!** - This helper is system required, if you remove it all hell breaks loose:

  **database**

    The database helper is a basic system helper (means its shipped with the basic version of firefly-php). It uses the database params you
    set inside the **config.php** to create a database connection (connection build up call is placed inside **bootstrap.php**).

    It contains 5 public methods
      - **connect()**               // Builds up a database connection using the db credentials set at **config.php** / is called default in bootstrap.php
                                    // using a static/cached object so you can refer to the same database connection at the full project source.
      - **query()**                 // Used to set up a mysql qry, it accepts 2 params - for more information read the database helper or simply ask me.
      - **fetch()**                 // Fetches the ressource returned by query() and returns an array
      - **getInsertId()**           // Returns the last id created by inserting data via the connection used by that database object
      - **disconnect()**            // Disconnect the connection of this database object

  **dbMapper**

    The database helper is a basic system helper (means its shipped with the basic version of firefly-php).
    It is meant for a better structured database usage. The followin explaination should show its usecase.

    The dbMapper gets called like every other helper. It provides one public function to use - **"get("{param}")"**. The function expects one string as parameter.
    The thought behind this is that you never need all database depending functions at once. You can split them by tables / context. So what this helper
    should do is deliver a instance of the **{name}Mapper** class inside **app/helper/dbMapper/tables/** directory. In the followin example we assume the existenz
    of the **"showsMapper"** inside the **tables/** directory.

    ```php
    helper::getInstance("dbMapper")->get("shows");
    ```

    Now you can use the **showsMapper** instance to call all methods that include **shows** regarding functions.

    It's not forced to use this structure but its highly recommended due its efficiency plus (loading only ressources that are needed).

    To create a new Mapper use this instructions:

      1. Create a file inside the subdirectory **tables/**
        - **app/helper/dbMapper/tables/{name}Mapper.php**

      2. Create a class inside the in 1. created file wich has the
      same naming plus the string **"Mapper"** 
        - ```php class {name}Mapper { .... }        //for example: class showsMapper { .... } ```