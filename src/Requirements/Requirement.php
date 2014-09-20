<?php namespace Guiwoda\Framework\Requirements;

class Requirement
{
	protected $class;
	protected $parameters;

	function __construct($class, array $parameters = [])
	{
		$this->class      = $class;
		$this->parameters = $parameters;
	}

	/**
	 * @return array
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 * @return string
	 */
	public function getClass()
	{
		return $this->class;
	}
}