<?php

global $CFG;

require_once $CFG->dirroot . '/local/package_demo/lib.php';

class local_package_demo_usercreate_test extends advanced_testcase
{
  
  /**
   * Test instance methods
   * 
   * @return null
   */
  public function testInstance()
  {
    $mock = $this->getMock(
      "packageDemoEventsHandler"
    );
    
    packageDemoEventsHandler::setInstance($mock);
    
    $this->assertEquals($mock, packageDemoEventsHandler::getInstance());
  }
  
  /**
   * Run Moodle event
   * 
   * @return null
   */
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
  
  /**
   * Run defined event handler method
   * 
   * @return null
   */
  public function testCall()
  {
    $user = new stdClass();
    
    $instance = packageDemoEventsHandler::getInstance();
    $this->assertTrue($instance->userCreated($user));
  }
  
  /**
   * Run not defined event handler method
   * 
   * @return null
   */
  public function testCallNotDefined()
  {
    $instance = packageDemoEventsHandler::getInstance();
    $this->assertTrue($instance->notEvent());
  }
  
  /**
   * Sets up the fixture
   *
   * @return null
   */
  protected function setUp()
  {
    packageDemoEventsHandler::clearInstance();
  }
  
  /**
   * Tears down the fixture
   * 
   * @return null
   */
  protected function tearDown()
  {
    packageDemoEventsHandler::clearInstance();
  }
  
}
