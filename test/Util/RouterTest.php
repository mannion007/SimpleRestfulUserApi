<?php
use UserApi\Util\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{
    
    private $router;
    
    public function setUp()
    {
        $this->router = new Router();
    }
    
    public function testDetermineController()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('determineController');
  
        $this->assertSame(
            'UserApi\Controller\PizzaController',
            $method->invokeArgs($this->router, array('/pizza/eat/1'))
        );
        
        $this->assertSame(
            'UserApi\Controller\DonutController',
            $method->invokeArgs($this->router, array('/donut/give/'))
        );
        
        $this->assertSame(
            'UserApi\Controller\SquisheeController',
            $method->invokeArgs($this->router, array('/squishee/drink'))
        );
    }
    
    public function testDetermineAction()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('determineAction');
  
        $this->assertSame(
            'eatAction',
            $method->invokeArgs($this->router, array('/pizza/eat/1'))
        );
        
        $this->assertSame(
            'giveAction',
            $method->invokeArgs($this->router, array('/donut/give/'))
        );
        
        $this->assertSame(
            'drinkAction',
            $method->invokeArgs($this->router, array('/squishee/drink'))
        );
    }
    
    public function testValidateUriWhenItIsNotValid()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateUri');
        
        $this->assertFalse($method->invokeArgs($this->router,array('/')));
        $this->assertFalse($method->invokeArgs($this->router,array('/user')));
        $this->assertFalse($method->invokeArgs($this->router,array('/user/')));
    }
    
    public function testValidateUriWhenItIsValid()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateUri');
        
        $this->assertFalse($method->invokeArgs($this->router,array('/orange/eat')));
        $this->assertFalse($method->invokeArgs($this->router,array('/juice/drink')));
        $this->assertFalse($method->invokeArgs($this->router,array('/pear/throw/')));
        $this->assertFalse($method->invokeArgs($this->router,array('/apple/eat/1')));
        $this->assertFalse($method->invokeArgs($this->router,array('/apple/eat/1/quickly')));
    }
    
    public function testValidateControllerWhenControllerDoesExist()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateController');
        
        $this->assertTrue($method->invokeArgs($this->router,array('UserApi\Controller\UserController')));
    }
    
    public function testValidateControllerWhenControllerDoesNotExist()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateController');
        
        $this->assertFalse($method->invokeArgs($this->router,array('Random\Something\SomethingElse')));
    }
    
    public function testValidateActionWhenActionDoesExist()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateAction');
        
        $actionsToTest = array('createAction', 'viewAction', 'updateAction', 'deleteAction');
        
        foreach($actionsToTest as $actionToTest) {
            $this->assertTrue(
                $method->invokeArgs(
                    $this->router,
                    array(
                        'UserApi\Controller\UserController',
                        $actionToTest
                    )
                ),
                'Failed to assert that the action "' . $actionToTest . '" exists in the UserController'
            );
        }
    }
    
    public function testValidateActionWhenActionDoesNotExist()
    {
        /** Method is private */
        $method = $this->getPrivateMethodForTest('validateAction');
        
        $this->assertFalse(
            $method->invokeArgs(
                $this->router,
                array(
                    'UserApi\Controller\UserController',
                    'ThrowBallAction'
                )
            )
        );
    }
    
    public function testErrorResponse()
    {
        /** Method is protected */
        $method = $this->getPrivateMethodForTest('errorResponse');
        
        $this->expectOutputString('{"error":"My Pizza is Cold"}');
        $method->invokeArgs($this->router, array('My Pizza is Cold'));
    }
    
    private function getPrivateMethodForTest($methodName)
    {
        $reflectedClass = new ReflectionClass('UserApi\Util\Router');
        $method = $reflectedClass->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }
}