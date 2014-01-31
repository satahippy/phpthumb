<?php
include 'vendor/autoload.php';

$phpThumb = new Sata\PhpThumb\Thumb(array(
	'config_cache_directory' => __DIR__ . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . 'cache',
	'config_cache_url' => '/test/cache'
));

foreach (array('test.jpg', 'test2.jpg', 'test3.png') as $image) {
	$thumb = $phpThumb->thumb(__DIR__ . DIRECTORY_SEPARATOR . 'test' . DIRECTORY_SEPARATOR . $image, array(
			'w' => 300,
			'h' => 300,
			'zc' => 1
		));
	echo $thumb->path . '<br/>';
	echo $thumb->url . '<br/>';
	echo '<img src="' . $thumb->url . '" /><br/>';
	echo '<br/><br/><br/>';
}
?>