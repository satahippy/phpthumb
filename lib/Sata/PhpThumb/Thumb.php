<?php

namespace Sata\PhpThumb;

class Thumb
{
	public $parameters;

	public function __construct($parameters = array())
	{
		$this->parameters = $parameters;
	}

	public function thumb($image, $options)
	{
		$phpThumb = new PhpThumb();
		$phpThumb->setParameters(array_merge($this->parameters, $options));
		$phpThumb->setSourceFilename($image);
		$phpThumb->setCacheDirectory();
		$phpThumb->SetCacheFilename();

		if (!is_readable($phpThumb->path)) {
			$phpThumb->GenerateThumbnail();
			if (is_writable(dirname($phpThumb->path)) || (file_exists($phpThumb->path) && is_writable($phpThumb->path))) {
				$phpThumb->CleanUpCacheDirectory();
				if ($phpThumb->RenderToFile($phpThumb->path) && is_readable($phpThumb->path)) {
					chmod($phpThumb->path, 0644);
				}
			}
		}

		return $phpThumb;
	}
}