<?php namespace Guiwoda\DomainRequirements\Requirements;

use Guiwoda\DomainRequirements\Contracts\Requirement as iRequirement;
use Guiwoda\DomainRequirements\Contracts\Responsible as iResponsible;
use Guiwoda\DomainRequirements\Contracts\Resolver    as iResolver;
use ReflectionClass;

class Resolver implements iResolver
{
	public function satisfies(iRequirement $requirement, iResponsible $responsible)
	{
		$requiredClass = new ReflectionClass($requirement->getClass());
		$givenClass    = new ReflectionClass($responsible->getResponsibility());

		return $this->isSatisfiedBy($requiredClass, $givenClass);
	}

	public function satisfiesInterface(ReflectionClass $requiredClass, ReflectionClass $givenClass)
	{
		if ($requiredClass->isInterface())
		{
			return $givenClass->implementsInterface($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesInheritance(ReflectionClass $requiredClass, ReflectionClass $givenClass)
	{
		if (! $requiredClass->isInterface())
		{
			return $givenClass->isSubclassOf($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesImplementation(ReflectionClass $requiredClass, ReflectionClass $givenClass)
	{
		if (! $requiredClass->isInterface() && ! $requiredClass->isAbstract())
		{
			return $givenClass->getName() == $requiredClass->getName();
		}
	}

	protected function isSatisfiedBy(ReflectionClass $requiredClass, ReflectionClass $givenClass)
	{
		return
			$this->satisfiesInterface($requiredClass, $givenClass) ||
			$this->satisfiesInheritance($requiredClass, $givenClass) ||
			$this->satisfiesImplementation($requiredClass, $givenClass);
	}
} 