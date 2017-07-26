<?php

namespace Tests;

use \AdService\Stamp;
use \PHPUnit\Framework\TestCase;

 /**
  * @runTestsInSeparateProcesses
  */

class StampTest extends TestCase
    {

	/**
	 * Prepare data for testing
	 *
	 * @return void
	 */

	public function setUp()
	    {
		parent::setUp();
	    } //end setUp()


	/**
	 * Destroy testing data
	 *
	 * @return void
	 */

	public function tearDown()
	    {
		parent::tearDown();
	    } //end setUp()


	/**
	 * Should make stamp
	 *
	 * @return void
	 */

	public function testShouldMakeStamp()
	    {
		$dir   = __DIR__ . "/datasets/stamp/";
		$photo = base64_encode(file_get_contents($dir . "new.jpg"));
		$stamp = new Stamp();
		$res   = $stamp->stamp($photo, ["stamp", "text"]);
		$this->assertEquals($res, base64_encode(file_get_contents($dir . "/expected.jpg")));
	    } //end testShouldMakeStamp()


    } //end class

?>
