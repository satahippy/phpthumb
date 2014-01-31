<?php

namespace Sata\PhpThumb;

require_once __DIR__ . '/src/phpthumb.class.php';

class PhpThumb extends \phpthumb
{
	public $config_cache_url = null;

	// override phpthumb default
	public $config_output_format = null;

	public $path;
	public $url;

	function SetCacheFilename()
	{
		if (!parent::SetCacheFilename()) {
			return false;
		}

		$this->path = $this->cache_filename;
		$this->url = str_replace(DIRECTORY_SEPARATOR, '/', preg_replace('$^' . preg_quote($this->config_cache_directory) . '$', $this->config_cache_url, $this->path));

		return true;
	}

	function setCacheDirectory()
	{
		return $this->ensurePathExists($this->config_cache_directory) && parent::setCacheDirectory();
	}

	protected function ensurePathExists($path)
	{
		if (is_dir($path)) {
			return true;
		}

		$prev_path = substr($path, 0, strrpos($path, DIRECTORY_SEPARATOR, -2) + 1);
		$return = $this->ensurePathExists($prev_path);

		return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}

	public function setParameters($parameters)
	{
		foreach ($parameters as $key => $val) {
			$this->setParameter($key, $val);
		}
	}
}