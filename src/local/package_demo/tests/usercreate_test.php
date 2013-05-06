<?php

global $CFG;

require_once $CFG->dirroot . '/local/package_demo/lib.php';

class local_package_demo_usercreate_test extends advanced_testcase
{
  
  public function testInstance()
  {
    $mock = $this->getMock(
      "packageDemoEventsHandler"
    );
    
    packageDemoEventsHandler::setInstance($mock);
    
    $this->assertEquals($mock, packageDemoEventsHandler::getInstance());
  }
  
  public function testUserCreateEvent()
  {
    $this->resetAfterTest(true);
    
    $user = $this->getDataGenerator()->create_user();
    
    $mock = $this->getMock(
      "packageDemoEventsHandler", 
      array("createUser")
    );
    
    $mock
        ->expects($this->once())
        ->method("createUser")
        ->with($user)
        ->will($this->returnValue(true));
    
    packageDemoEventsHandler::setInstance($mock);
    
    events_trigger("user_created", $user);
  }
  
  public function testCall()
  {
    $user = new stdClass();
    
    $instance = packageDemoEventsHandler::getInstance();
    $this->assertTrue($instance->userCreated($user));
  }
  
  public function testCallNotDefined()
  {
    $instance = packageDemoEventsHandler::getInstance();
    $this->assertTrue($instance->notEvent());
  }
  
  protected function setUp()
  {
    packageDemoEventsHandler::clearInstance();
  }
  
  protected function tearDown()
  {
    packageDemoEventsHandler::clearInstance();
  }
  
}
