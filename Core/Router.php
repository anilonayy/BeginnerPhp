<?php

namespace Core;

use Core\Middleware\Middleware;

class Router {

   protected $routes = [];

   protected function add($uri,$controller,$method) 
   {
      $this->routes[] = [
         'uri' => $uri,
         'controller' => $controller,
         'method'=> $method,
         'middleware' => null
      ];
   }

   
   public function get($uri,$controller) 
   {  
      $this->add($uri,$controller,'GET');
      return $this;
   }

   public function post($uri,$controller) 
   {
      $this->add($uri,$controller,'POST');
      return $this;
   }

   public function delete($uri,$controller) 
   {
      $this->add($uri,$controller,'DELETE');
      return $this;
   }

   public function patch($uri,$controller) 
   {
      $this->add($uri,$controller,'PATCH');
      return $this;
   }

   public function put($uri,$controller) 
   {
      $this->add($uri,$controller,'PUT');
      return $this;
   }

   public function previousUrl() 
   {
      return $_SERVER['HTTP_REFERER'];
   }

   protected function abort($statusCode = 404) {
      http_response_code($statusCode);
      require base_path("views/{$statusCode}.php");
      die();
   }

   public function only(string $key) 
   {
      $this->routes[array_key_last($this->routes)]['middleware'] = $key;       
   }

   protected function same(array $keys) 
   {
      
   }

   public function route($uri, $method) 
   {  
      foreach($this->routes as $route) {
         if($route['uri'] === $uri && $route['method'] === $method) {

            Middleware::resolve($route['middleware']);
      
            require_once base_path('Http/controllers/'.$route['controller']);
            Session::unFlash();
            exit();
         }
      }

      $this->abort(Response::NOT_FOUND);
   }

   
}
