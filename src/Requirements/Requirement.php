<?php namespace Guiwoda\DomainRequirements\Requirements;

use Guiwoda\DomainRequirements\Contracts\Requirement as iRequirement;

class Requirement implements iRequirement
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