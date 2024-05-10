
<?php

use App\Routes\Router;

require_once 'app/Helper/AutoLoader.php';
require_once 'app/Routes/Web.php';
require_once 'app/Routes/Api.php';
require_once 'app/Config/Container.php';

Router::route($_SERVER['REQUEST_METHOD']);
