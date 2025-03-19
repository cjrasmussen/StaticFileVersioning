<?php

namespace cjrasmussen\StaticFileVersioning;

use JsonException;

class FileVersion
{
	private string $config_path;
	private array $config;
	private bool $changed = false;

	/**
	 * @throws JsonException
	 */
	public function __construct($path)
	{
		$this->config_path = $path;
		$this->config = $this->loadConfig();
	}

	/**
	 * Get the value for the specified key
	 *
	 * @param string $key
	 * @return string|null
	 */
	public function get(string $key): ?string
	{
		if (array_key_exists($key, $this->config)) {
			return (string)$this->config[$key];
		}

		return null;
	}

	/**
	 * Set a new value for the specified key
	 * 
	 * @param string $key
	 * @param mixed $value
	 * @return $this
	 */
	public function set(string $key, $value): self
	{
		if ($this->config[$key] !== $value) {
			$this->config[$key] = $value;
			$this->changed = true;
		}

		return $this;
	}

	/**
	 * Save the current configuration to the config file
	 *
	 * @throws JsonException
	 */
	public function save(): void
	{
		if ($this->changed) {
			file_put_contents($this->config_path, json_encode($this->config, JSON_THROW_ON_ERROR));
			$this->changed = false;
		}
	}

	/**
	 * Load the current config file
	 *
	 * @return array
	 * @throws JsonException
	 */
	private function loadConfig(): array
	{
		$config = [];

		if (!file_exists($this->config_path)) {
			return $config;
		}

		$data = file_get_contents($this->config_path);
		if ($data) {
			$config = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
		}

		return $config;
	}
}