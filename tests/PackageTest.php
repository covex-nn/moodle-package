<?php

class PackageTest extends PHPUnit_Framework_TestCase
{
  
  /**
   * Test composer.json
   * 
   * @return null
   */
  public function testComposerJson()
  {
    $composer = json_decode(
      file_get_contents(dirname(__DIR__) . "/composer.json")
    );
    
    $this->assertEquals(
      "moodle-package", 
      $composer->type, 
      "composer.json: package type must be 'moodle-package'"
    );
    
    $modules = $composer->extra->{"moodle-modules"};
    $this->assertTrue(
      is_object($modules), 
      "composer.json: modules must be described in extra/moodle-modules section"
    );
    
    foreach ($modules as $folder => $vendorFolder) {
      $this->assertFileExists(
        dirname(__DIR__) . "/" . $vendorFolder, 
        "composer.json: folder '$vendorFolder' for 'www/$folder' does not exists"
      );
    }
  }
  
}
