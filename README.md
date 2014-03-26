RedSlim (Slim + Twig + Redbean), a PHP micro framework
======================================================

[![Latest Stable Version](https://poser.pugx.org/redslim/redslim/v/stable.png)](https://packagist.org/packages/redslim/redslim)

RedSlim is a lightweight PHP framework that bundling the following open source components. Its dependency is managed by **Composer** and can be easily updated. By default, RedSlim is configured to run with SQLite database. The database abstraction is done by Redbean, a simple and initutive ORM tool. With its fluid mode enabled, you can incrementally test and build your database schema and start prototyping your idea immediately. RedSlim is a zero-configuration framework for you to get start and learn quickly. You can also switch to other databases and use it for serious project. 

To learn more about these powerful components, check this out:

* **Controller/Routing**: Slim ([codeguy/Slim](https://github.com/codeguy/Slim))
* **Model/Persistence/ORM**: RedBean ([gabordemooij/redbean](https://github.com/gabordemooij/redbean))
* **View/Template**: Twig ([fabpot/Twig](https://github.com/fabpot/Twig))
* **UI Toolkit**: Twitter Bootstrap ([twitter/bootstrap](https://github.com/twitter/bootstrap))

## Versions

There are two branches - *master* and *php52*. Because many new PHP features (e.g. closure) require PHP5.3+ and so do the above components, *php52* is a special release for those who have no choice to upgrade server version but still want to deploy RedSlim. This branch will not receive further support and development.

## Installation

### Pagoda Box Quickstart

Pagoda Box is a flexible PHP cloud hosting. This Quickstart installation of RedSlim includes a preconfigured **MySQL** database and **Redis** cache. You can install RedSlim either directly from the [Pagoda Box App Cafe](https://pagodabox.com/cafe/vanting/redslim), as a Quickstart through your Pagoda Box dashboard during the new application creation process, or by cloning the [GitHub repository](https://github.com/vanting/RedSlim.git) and pushing it to an empty Pagoda Box application repository.

### Self Managed Server

The instructions below assume you are running a **LAMP** stack in Ubuntu or any other **apt**-based distributions. To allow Slim to route with clean path syntax, you need to enable the url rewrite module.   

	sudo a2enmod rewrite
	sudo service apache2 restart

Optionally, if you want to run this demo with the default SQLite database, you need the driver

	sudo apt-get install php5-sqlite

Suppose your document root is in /var/www, clone the repository as follows:

	cd /var/www
	git clone https://github.com/vanting/RedSlim.git redslim

The required vendor libraries can be installed/updated using [Composer](http://getcomposer.org/). Go to the project root (where you see the file *composer.json*) and run the following command:

	cd ./redslim
	composer install

There are some directories should be made writeable to your web server process. 

	chmod -R 777 ./app/storage

Then, update your apache config file to set your document root to the **web** subdirectory. This helps to secure your scripts which should normally be put inside the **app/** folder.

	<VirtualHost *:80>
		DocumentRoot /var/www/redslim/web
		ServerName example.com
	</VirtualHost>

Note that in order to make the *.htaccess* effective, your main apache config file must allow subdirectory to override it.  

	<Directory "/var/www">
		AllowOverride All
	</Directory>


##Structure

* **app/** contains all files for your app: `models/`, `controllers/`, `views/` (Twig templates) and your `config/` (configuration). Slim is instantiated in `app/start.php`
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

## Credits

This project is inspired from [Tieno/SlimPackage](https://github.com/Tieno/SlimPackage/) and [briankiewel/pagodabox-laravel-4](https://github.com/briankiewel/pagodabox-laravel-4).

## License

The RedSlim framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

----------

[![githalytics.com alpha](https://cruel-carlota.pagodabox.com/0b6eb25e8a80d2b92efb67525823d25c "githalytics.com")](http://githalytics.com/vanting/RedSlim)
[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/vanting/RedSlim/trend.png)](https://bitdeli.com/free "Bitdeli Badge")

