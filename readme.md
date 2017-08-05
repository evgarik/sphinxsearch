Sphinx Search for Lumen 5 - Custom build with snippets support 
=======================
Simple Lumen 5 package for make queries to Sphinx Search.
Based in sngrl/sphinxsearch

This package was created to import to the site packagist.org and allow installation through Composer (https://getcomposer.org/).

Installation
=======================

Require this package in your composer.json:
 
```php
	"require": {
        /*** Some others packages ***/
		"evgarik/sphinxsearch": "dev-master",
	},
```

Run in your console `composer update` command to pull down the latest version of Sphinx Search.


Or just run this in console:

```php
composer require sngrl/sphinxsearch:dev-master
```

After updating composer, add the ServiceProvider in bootstrap/app.php:

```php
	$app->register ( sngrl\SphinxSearch\SphinxSearchServiceProvider::class );
```

You can add this line to the files, where you may use SphinxSearch:

```php
use sngrl\SphinxSearch\SphinxSearch;
```

Configuration
=======================

Create the file `config/sphinxsearch.php`. Modify as needed the host and port, and configure the indexes, binding them to a table and id column.

```php
return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		'my_index_name' => array ( 'table' => 'my_keywords_table', 'column' => 'id' ),
	)
);
```
Or disable the model querying to just get a list of result id's.
```php
return array (
	'host'    => '127.0.0.1',
	'port'    => 9312,
	'indexes' => array (
		'my_index_name' => FALSE,
	)
);
```


Usage
=======================

Basic query (raw sphinx results)
```php
$sphinx = new SphinxSearch();
$results = $sphinx->search('my query', 'index_name')->query();
```

Basic query (with Eloquent)
```php
$results = $sphinx->search('my query', 'index_name')->get();
```

Query another Sphinx index with limit and filters.
```php
$results = $sphinx->search('my query', 'index_name')
	->limit(30)
	->filter('attribute', array(1, 2))
	->range('int_attribute', 1, 10)
	->get();
```

Query with match and sort type specified.
```php
$result = $sphinx->search('my query', 'index_name')
	->setFieldWeights(
		array(
			'partno'  => 10,
			'name'    => 8,
			'details' => 1
		)
	)
	->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
	->setSortMode(\Sphinx\SphinxClient::SPH_SORT_EXTENDED, "@weight DESC")
	->get(true);  //passing true causes get() to respect returned sort order
```


License
=======================

Sngrl Sphinx Search is open-sourced software licensed under the MIT license
