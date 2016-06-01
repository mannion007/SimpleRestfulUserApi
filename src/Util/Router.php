<?php

namespace UserApi\Util;
use UserApi\Constant\ErrorConstants;

class Router
{
    
    const CONTROLLER_NAMESPACE = 'UserApi\Controller\\';
    
    public function process()
    {
        $uri = $_SERVER['REQUEST_URI'];
        
        if(true === $this->validateUri($uri)) {
            
            $controllerName = $this->determineController($uri);
            $actionName = $this->determineAction($uri);
         
            if(true === $this->validateController($controllerName)) {
                
                if(true === $this->validateAction($controllerName, $actionName)) {
                    $controller = new $controllerName();
                    $controller->$actionName();
                } else {
                    $this->errorResponse(ErrorConstants::INVALID_RESOURCE);
                }
                
            } else {
                $this->errorResponse(ErrorConstants::INVALID_RESOURCE);
            }
        } else {
            $this->errorResponse(ErrorConstants::INVALID_RESOURCE);
        }
    }
    
    private function determineController($uri)
    {
        return self::CONTROLLER_NAMESPACE . ucwords(explode('/', $uri)[1]) . 'Controller';
    }
    
    private function determineAction($uri)
    {
        return strtolower(explode('/', $uri)[2]) . 'Action';
    }
    
    private function validateUri($uri)
    {
        $urlParts = array_filter(explode('/', $uri));
        
        echo count($urlParts);
        
        if(2 <= count($urlParts)) {
            return true;
        }
        
        return false;
    }
    
    private function validateController($controllerName)
    {
        return class_exists($controllerName);
    }
    
    private function validateAction($controllerName, $actionName)
    {
        return method_exists($controllerName, $actionName);
    }
    
    protected function errorResponse($errorMessage)
    {
        echo json_encode(array('error' => $errorMessage));
    }
}
