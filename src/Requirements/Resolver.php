<?php namespace Guiwoda\Framework\Requirements;

use Guiwoda\Framework\Contracts\Requirement as iRequirement;
use Guiwoda\Framework\Contracts\Responsible as iResponsible;

class Resolver
{
	public function satisfies(iRequirement $requirement, iResponsible $responsible)
	{
		$requiredClass = new \ReflectionClass($requirement->getClass());
		$givenClass    = new \ReflectionClass($responsible->respondsWith());

		return $this->isSatisfiedBy($requiredClass, $givenClass);
	}

	protected function isSatisfiedBy(\ReflectionClass $requiredClass, \ReflectionClass $givenClass)
	{
		return
			$this->satisfiesInterface($requiredClass, $givenClass) ||
			$this->satisfiesInheritance($requiredClass, $givenClass) ||
			$this->satisfiesImplementation($requiredClass, $givenClass);
	}

	public function satisfiesInterface(\ReflectionClass $requiredClass, \ReflectionClass $givenClass)
	{
		if ($requiredClass->isInterface())
		{
			return $givenClass->implementsInterface($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesInheritance(\ReflectionClass $requiredClass, \ReflectionClass $givenClass)
	{
		if (! $requiredClass->isInterface())
		{
			return $givenClass->isSubclassOf($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesImplementation(\ReflectionClass $requiredClass, \ReflectionClass $givenClass)
	{
		if (! $requiredClass->isInterface() && ! $requiredClass->isAbstract())
		{
			return $givenClass->getName() == $requiredClass->getName();
		}
	}
} 