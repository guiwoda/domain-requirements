<?php namespace Guiwoda\DomainRequirements\Responsibles;

use Guiwoda\DomainRequirements\Contracts\Requirement;
use Guiwoda\DomainRequirements\Contracts\Responsible as iResponsible;

class CallbackResponsible implements iResponsible
{
	/**
	 * @var string
	 */
	protected $responsibility;

	/**
	 * @var callable
	 */
	protected $resolverCallback;

	function __construct($responsibility, \Closure $resolverCallback)
	{
		$this->responsibility = $responsibility;
		$this->resolverCallback = $resolverCallback;
	}

	/**
	 * @return string
	 */
	public function getResponsibility()
	{
		return $this->responsibility;
	}

	/**
	 * @param Requirement $requirement
	 *
	 * @return mixed The object that it's responsible of returning
	 */
	public function satisfy(Requirement $requirement)
	{
		$resolver = $this->resolverCallback;

		return $resolver($requirement);
	}
}