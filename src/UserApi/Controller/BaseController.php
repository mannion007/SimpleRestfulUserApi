<?php

namespace UserApi\Controller;
use UserApi\Constant\ErrorConstants;

abstract class BaseController
{
    
    protected function validateRequestType($allowedType)
    {
        if ($_SERVER['REQUEST_METHOD'] !== $allowedType) {
            $this->errorResponse(ErrorConstants::INVALID_REQUEST_TYPE_FOR_RESOURCE);
        }
        return true;
    }
    
    protected function parsePutParameters()
    {
        $input = file_get_contents('php://input');
        parse_str($input, $parameters);
        return $parameters;
    }
    
    protected function parseGetParameters()
    {
        $urlParts = array_filter(explode('/', $_SERVER['REQUEST_URI']));
        $parameters = array_slice($urlParts, 2, count($urlParts));
        return $parameters;
    }
    
    protected function parsePostParameters()
    {
        return $_POST;
    }
    
    protected function validateParameters($requiredParameters, $providedParameters)
    {
        foreach($requiredParameters as $requiredParameter) {
            if(false === array_key_exists($requiredParameter, $providedParameters)) {
                $this->errorResponse(ErrorConstants::INVALID_PARAMETERS);
            }
        }
        return true;
    }
    
    protected function validateParameterCount($requiredCount, $providedParameters)
    {
        if ($requiredCount !== count($providedParameters)) {
            $this->errorResponse(ErrorConstants::INVALID_PARAMETERS);
        }
        return true;
    }
    
    protected function successResponse($response)
    {
        echo $response;
    }
    
    protected function errorResponse($errorMessage)
    {
        echo json_encode(array('error' => $errorMessage));
        exit();
    }

}
