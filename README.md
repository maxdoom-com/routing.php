routing.php
===========

This is a minimal set of routing functions for use with php.

## Example:

```php
<?php
@require('routing.php');

get('/', 'index');
function index()
{
	echo 1;
}

get('/([a-z]+)', function($tag){
	echo $tag;
});

get('/many', ['fn1', 'fn2']);
function fn1(){ echo 'fn1 called'; }
function fn2(){ echo 'fn2 called'; }

post('/do/something', 'Controller::do_sth');
class Controller
{
	public function do_sth()
	{
		var_dump($_POST);
	}
}

if( !dispatch() )
{
	die('404 - not found!');
}

```
