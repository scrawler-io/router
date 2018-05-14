<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RouterEngineTest extends TestCase
{
    private $engine;
    private $request;
    function __construct(){
    parent::__construct();

    $dir = __DIR__."/Demo";
    $namespace = "Tests\Demo";

    $collection = new \Scrawler\Router\RouteCollection($dir,$namespace);
    $this->request = Request::create(
    '/hello/world/pranjal',
    'GET'
     );

    $this->engine = new \Scrawler\Router\RouterEngine($this->request,$collection);
    }

    function testRoute(){
      $this->engine->route();
      $this->assertEquals($this->request->attributes->get('_controller'),'Test\Demo\Hello::getWorld');
      $this->assertEquals($this->request->attributes->get('_arguments'),'pranjal');
    }

      public function testGetRoutedController(){
        $this->engine->route();
        $this->assertEquals('Test\Controllers\Hello',$this->engine->getRoutedController());
      }


      public function testGetRoutedMethod(){
        $this->engine->route();
        $this->assertEquals('getWorld',$this->engine->getRoutedMethod());

      }

}
