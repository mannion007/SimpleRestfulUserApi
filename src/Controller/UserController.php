<?php

namespace UserApi\Controller;
use UserApi\Model;
use UserApi\Constant\UrlConstants;
use UserApi\Constant\RestConstants;
use UserApi\Constant\ErrorConstants;

class UserController extends BaseController
{

    public function createAction()
    {
        if(true === $this->validateRequestType(RestConstants::PUT_METHOD)) {
            
            $providedParameters = $this->parsePutParameters();
            
            if(true === $this->validateParameters(
                array(UrlConstants::FORENAME, UrlConstants::SURNAME, UrlConstants::EMAIL),
                $providedParameters
                )
            ) {
                $user = new Model\User();
                $user->setForename($providedParameters[UrlConstants::FORENAME]);
                $user->setSurname($providedParameters[UrlConstants::SURNAME]);
                $user->setEmail($providedParameters[UrlConstants::EMAIL]);
                $user->save();
                $this->successResponse($user->toJson());
            }
        }
    }
    
    public function updateAction()
    {
        if(true === $this->validateRequestType(RestConstants::POST_METHOD)) {
            
            $providedParameters = $this->parsePostParameters();
            
            if(true === $this->validateParameters(
                 array(UrlConstants::ID, UrlConstants::FORENAME, UrlConstants::SURNAME, UrlConstants::EMAIL),
                 $providedParameters
                 )
             ) {
                $query = new Model\UserQuery();
                $user = $query->findPK($providedParameters[UrlConstants::ID]);
                
                if(null === $user) {
                    $this->errorResponse(ErrorConstants::USER_NOT_FOUND);
                } else {
                    $user->setForename($providedParameters[UrlConstants::FORENAME]);
                    $user->setSurname($providedParameters[UrlConstants::SURNAME]);
                    $user->setEmail($providedParameters[UrlConstants::EMAIL]);
                    $user->save();
                    $this->successResponse($user->toJson());
                }
            }
        }
    }
    
    public function viewAction()
    {
        if(true === $this->validateRequestType(RestConstants::GET_METHOD)) {
            
            $providedParameters = $this->parseGetParameters();
            
            if(true === $this->validateParameterCount(1, $providedParameters)) {
                $query = new Model\UserQuery();
                $user = $query->findPK($providedParameters[0]);
                
                if(null === $user) {
                    $this->errorResponse(ErrorConstants::USER_NOT_FOUND);
                } else {
                    $this->successResponse($user->toJson());  
                }
            }
        }
    }
    
    public function deleteAction()
    {
        if(true === $this->validateRequestType(RestConstants::DELETE_METHOD)) {
            
            $providedParameters = $this->parseGetParameters();
            
            if(true === $this->validateParameterCount(1, $providedParameters)) {
                $query = new Model\UserQuery();
                $user = $query->findPK($providedParameters[0]);
                
                if(null === $user) {
                    $this->errorResponse(ErrorConstants::USER_NOT_FOUND);
                } else {
                    $user->delete();
                    $this->successResponse($user->toJson());
                }
            }
        }
    }
}
