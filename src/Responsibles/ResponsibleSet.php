<?php namespace Guiwoda\DomainRequirements\Responsibles;

use Guiwoda\DomainRequirements\Contracts\Requirement;
use Guiwoda\DomainRequirements\Contracts\Resolver;
use Guiwoda\DomainRequirements\Contracts\Responsible;

class ResponsibleSet implements \Iterator
{
	protected $responsibles = [];

	function __construct(array $responsibles = [])
	{
		$this->responsibles = $responsibles;
	}

	public function add(Responsible $responsible)
	{
		$this->responsibles[$responsible->getResponsibility()] = $responsible;

		return $this;
	}

	/**
	 * @param Requirement $requirement
	 * @param Resolver    $resolver
	 *
	 * @return Responsible
	 * @throws ResponsibleNotFoundException
	 */
	public function getFor(Requirement $requirement, Resolver $resolver)
	{
		foreach ($this->responsibles as $responsible)
		{
			if ($resolver->satisfies($requirement, $responsible))
			{
				return $responsible;
			}
		}

		throw new ResponsibleNotFoundException('No responsible found for requirement: ' . $requirement->getClass());
	}

	public function isEmpty()
	{
		return empty($this->responsibles);
	}

	public function current()
	{
		return current($this->responsibles);
	}

	public function next()
	{
		return next($this->responsibles);
	}

	public function key()
	{
		return key($this->responsibles);
	}

	public function valid()
	{
		return current($this->responsibles) !== false;
	}

	public function rewind()
	{
		reset($this->responsibles);
	}
}