<?php namespace Guiwoda\Framework\Requirements;

use Guiwoda\Framework\Contracts\Requirement as iRequirement;

class Resolver
{
	public function satisfies(iRequirement $requirement, $satisfier)
	{
		$requiredClass = new \ReflectionClass($requirement->getClass());
		$givenClass    = new \ReflectionObject($satisfier);

		if (! $this->isSatisfiedBy($requiredClass, $givenClass))
		{
			throw new RequirementNotMetException($givenClass->getName() . ' does not satisfy ' . $requiredClass->getName());
		}

		return $satisfier;
	}

	protected function isSatisfiedBy(\ReflectionClass $requiredClass, \ReflectionObject $givenClass)
	{
		return
			$this->satisfiesInterface($requiredClass, $givenClass) ||
			$this->satisfiesInheritance($requiredClass, $givenClass) ||
			$this->satisfiesImplementation($requiredClass, $givenClass);
	}

	public function satisfiesInterface(\ReflectionClass $requiredClass, \ReflectionObject $givenClass)
	{
		if ($requiredClass->isInterface())
		{
			return $givenClass->implementsInterface($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesInheritance(\ReflectionClass $requiredClass, \ReflectionObject $givenClass)
	{
		if (! $requiredClass->isInterface())
		{
			return $givenClass->isSubclassOf($requiredClass->getName());
		}

		return false;
	}

	public function satisfiesImplementation(\ReflectionClass $requiredClass, \ReflectionObject $givenClass)
	{
		if (! $requiredClass->isInterface() && ! $requiredClass->isAbstract())
		{
			return $givenClass->getName() == $requiredClass->getName();
		}
	}
} 