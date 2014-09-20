<?php namespace Guiwoda\Framework\Responsibles;

use Guiwoda\Framework\Contracts\Requirement;
use Guiwoda\Framework\Contracts\Responsible;
use Guiwoda\Framework\Contracts\Resolver;

class ResponsibleFinder
{
	/**
	 * @var ResponsibleSet
	 */
	protected $responsibleSet;

	/**
	 * @var \Guiwoda\Framework\Requirements\Resolver
	 */
	protected $resolver;

	function __construct(Resolver $resolver, ResponsibleSet $responsibleSet)
	{
		$this->resolver = $resolver;
		$this->responsibleSet = $responsibleSet;
	}

	public function addResponsible(Responsible $responsible)
	{
		$this->responsibleSet->add($responsible);
	}

	/**
	 * @param Requirement $requirement
	 *
	 * @return mixed
	 * @throws ResponsibleNotFoundException
	 */
	public function find(Requirement $requirement)
	{
		$responsible = $this->responsibleSet->getFor($requirement, $this->resolver);

		return $responsible->satisfy($requirement);
	}
}