RedSlim (Slim + Twig + Redbean), a PHP micro framework
======================================================

This project is inspired from ([Tieno/SlimPackage](https://github.com/Tieno/SlimPackage/)).

RedSlim is a lightweight PHP framework that bundling the following MVC components. 
By default, it is operated under the fluid mode of Redbean ORM with SQLite database.
Therefore it is very suitable for quick prototyping and requires zero configuration.
You can also switch to other databases and use it for serious project. 

* **MVC**: Slim ([codeguy/Slim](https://github.com/codeguy/Slim))
* **Template Engine**: Twig ([fabpot/Twig](https://github.com/fabpot/Twig))
* **ORM**: RedBean ([gabordemooij/redbean](https://github.com/gabordemooij/redbean))
* **UI Toolkit**: Twitter Bootstrap ([twitter/bootstrap](https://github.com/twitter/bootstrap))

## Installation

### Pagoda Box Quickstart

The Quickstart installation of RedSlim includes a preconfigured **MySQL** database and **Redis** cache. You can install the Quickstart either directly from the [Pagoda Box App Cafe](https://pagodabox.com/cafe/vanting/redslim), as a Quickstart through your Pagoda Box dashboard during the new application creation process, or by cloning the [GitHub repository](https://github.com/vanting/RedSlim.git) and pushing it to an empty Pagoda Box application repository.

### Your Own Server

Download the tarball or clone the repository to your server, then point your document root to the **web/** subdirectory.

	DocumentRoot /var/www/html/redslim/web

## Update 

### Composer

The bundled vendor libraries can be updated using [Composer](http://getcomposer.org/). Go to the project root (where you see the file *composer.json*) and run the following command:

	composer update

##Structure

* **app/** contains all files for your app: `models/`, `controllers/`, `views/` (Twig templates) and your `config/` (configuration). Slim is instantiated in `app/index.php`
* **vendor/** contains the libraries for your application, and you can update them with composer.
* **web/** is for your assets: js/css/img files. It should be the only folder publically available so your domain should point to this folder. `web/index.php` bootstraps the rest of the application.

##Writable Directory

* **app/storage/db/** contains SQLite database file.
* **app/storage/cache/twig/** contains the twig template cache.
* **app/storage/logs/** contains the error logs.

## Additions

#### Demo

* Site: [http://redslim.gopagoda.com/](http://redslim.gopagoda.com/)
    
#### Macros

* Bootstrap macros in `views/macros/bootstrap.twig`
    * alert
    * label
    * btn

#### Templates

There are a couple of Twig templates in this package. They are included for common use.

* A Bootstrap Hero template: `base/hero.html.twig`
* A Bootstrap Fluid template: `base/fluid.html.twig`
* Both of these templates have Slim flash capabilities. The flash template is located in `base/components/flash.twig`
* A Bootstrap login form template: `/login.html.twig`


----------


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/vanting/RedSlim/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

