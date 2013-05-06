<?php

/**
 * Local plugin lib
 */

/**
 * Event handler
 * 
 * @param stdClass $user New user
 * 
 * @return boolean
 */
function package_demo_usercreated_handler($user)
{
  $instance = packageDemoEventsHandler::getInstance();
  return $instance->createUser($user);
}

/**
 * Events handler
 * 
 * @method boolean createUser(stdClass $user) User created
 */
class packageDemoEventsHandler
{
  
  /**
   * @var packageDemoEventHandler
   */
  private static $_instance = null;
  
  /**
   * Return instance
   * 
   * @return packageDemoEventHandler
   */
  public static function getInstance()
  {
    if (is_null(self::$_instance)) {
      self::setInstance(new self());
    }
    return self::$_instance;
  }
  
  /**
   * Sets events handler instance
   * 
   * @param packageDemoEventHandler $instance Events handler
   * 
   * @return null
   */
  public static function setInstance(packageDemoEventHandler $instance)
  {
    self::$_instance = $instance;
  }
  
  /**
   * Clear events handler instance
   * 
   * @return null
   */
  public static function clearInstance()
  {
    self::$_instance = null;
  }
  
  /**
   * Magic method __call
   * 
   * @param string $name      Method name
   * @param array  $arguments Arguments
   */
  public function __call($name, $arguments)
  {
    $method = "_eventHandler" . ucfirst($name);
    if (method_exists($this, $method)) {
      array_shift($arguments);
      $result = call_user_method_array($method, $this, $arguments);
    } else {
      $result = true;
    }
    return $result;
  }
  
  /**
   * User created user handler
   * 
   * @param stdClass $user New user
   * 
   * @return true
   */
  protected function _eventHandlerUserCreated($user)
  {
    return !!$user;
  }
  
}
