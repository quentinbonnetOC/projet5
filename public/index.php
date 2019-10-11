<?php
session_start();
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
if($_SERVER['SERVER_NAME']=="localhost"){ 
    $_SESSION['request_uri'] = $_SERVER['REQUEST_URI']."public/";
}else if($_SERVER['SERVER_NAME']=="projet5.quentin-bonnet.fr"){
    $_SESSION['request_uri'] = "/public/";

}else{
    var_dump($_SERVER['SERVER_NAME']);die();
}
try {
    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    
    $di = new FactoryDefault();
    
    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Application($di);
    try {
        $response = $application->handle();
    
        $response->send();
    } catch (\Exception $e) {
        echo 'Exception: ', $e->getMessage();
    }
   // echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
