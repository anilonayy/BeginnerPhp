<?php

namespace Core;

class Container
{
    protected $container = [];

    public function bind(string $key,callable $resolver) 
    {
        $this->container[$key] =  $resolver;         
    }    
    /**
     * Resolver Function
     *
     * @param string $key
     * @return void
     */ 
    public function resolve(string $key) 
    {
        if(!(array_key_exists($key, $this->container))) {
            throw new \Exception("The key can not find key for \"{$key}\" in container.");
        }

        if((array_key_exists($key, $this->container))) {
            $resolver = $this->container[$key];
            return call_user_func($resolver);
        }
    }    
}
