<?php

namespace AdService;

use \Images\LImageHandler;

class Stamp
    {

	/**
	 * Construct class
	 *
	 * @return void
	 */

	public function __construct()
	    {
	    } //end __construct()


	/**
	 * Make stamp
	 *
	 * @param string $photo Base64Binary photo
	 * @param array  $texts Texts to photo
	 *
	 * @return void
	 */

	public function stamp(string $photo, array $texts)
	    {
		$stamped = "";

		if (file_exists(__DIR__ . "/tmp") === false)
		    {
			mkdir(__DIR__ . "/tmp");
		    } //end if

		$name = sha1($photo) . ".jpg";
		if (strlen($photo) > 100 && sha1($photo) !== "dfa3a49eb8e007b3a30cdc58c40285b5e6d475e7")
		    {
			file_put_contents(__DIR__ . "/tmp/" . $name, base64_decode($photo));
			$im = new \Imagick (__DIR__ . "/tmp/" . $name); 
			$im->cropThumbnailImage(600, 600);
			$im->writeImage (__DIR__ . "/tmp/" . $name); 
			$fontPath  = __DIR__ . "/fonts/aavanteint_bolditalic.ttf";
			$imagePath = __DIR__ . "/tmp/" . $name;
			$fontSize  = 15;
			$color     = array(0, 0, 0);

			$backgroundColor = array(10, 255, 80);

			$ih     = new LImageHandler;
			$imgObj = $ih->load($imagePath);
			$imgObj->textWithBackground($texts[0], $fontPath, 15, $color, $backgroundColor, LImageHandler::CORNER_RIGHT_TOP, 5, 50, 0, 15, 10);
			$imgObj->textWithBackground($texts[1], $fontPath, 20, $color, $backgroundColor, LImageHandler::CORNER_RIGHT_BOTTOM, 2, 40, 0, 0, 25);
			$imgObj->save(__DIR__ . "/tmp/" . $name, IMG_JPEG, 45);

			$stamped = base64_encode(file_get_contents(__DIR__ . "/tmp/" . $name));
			unlink(__DIR__ . "/tmp/" . $name);
		    }

		return $stamped;
	    } //end stamp()


    } //end class

?>
