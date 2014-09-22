<?php namespace Guiwoda\DomainRequirements\Responsibles;

use Guiwoda\DomainRequirements\Contracts\Requirement;
use Guiwoda\DomainRequirements\Contracts\Responsible;
use Guiwoda\DomainRequirements\Contracts\Resolver;

class ResponsibleFinder
{
	/**
	 * @var ResponsibleSet
	 */
	protected $responsibleSet;

	/**
	 * @var \Guiwoda\DomainRequirements\Requirements\Resolver
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