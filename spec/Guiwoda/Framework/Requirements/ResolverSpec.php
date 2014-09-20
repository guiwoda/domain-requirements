<?php namespace spec\Guiwoda\Framework\Requirements;

use Guiwoda\Framework\Requirements\Requirement;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ResolverSpec
 * @package spec\Guiwoda\Framework\Requirements
 * @mixin \Guiwoda\Framework\Requirements\Resolver
 */
class ResolverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\Framework\Requirements\Resolver');
    }

	function it_should_satisfy_an_interface_with_an_object_that_implements_it()
	{
		$requirement = new Requirement(anInterface::class);
		$satisfier = new anInterfaceImplementation();

		$this->satisfies($requirement, $satisfier)->shouldReturn($satisfier);
	}

	function it_shouldnt_satisfy_an_interface_with_an_object_that_doesnt_implement_it()
	{
		$requirement = new Requirement(anInterface::class);
		$satisfier = new aClass();

		$this->shouldThrow('Guiwoda\Framework\Requirements\RequirementNotMetException')
			->duringSatisfies($requirement, $satisfier);
	}

	function it_should_satisfy_an_abstract_class_with_an_object_that_implements_it()
	{
		$requirement = new Requirement(anAbstractClass::class);
		$satisfier = new anAbstractClassImplementation();

		$this->satisfies($requirement, $satisfier)->shouldReturn($satisfier);
	}

	function it_shouldnt_satisfy_an_abstract_class_with_an_object_that_doesnt_implement_it()
	{
		$requirement = new Requirement(anAbstractClass::class);
		$satisfier = new aClass();

		$this->shouldThrow('Guiwoda\Framework\Requirements\RequirementNotMetException')
			->duringSatisfies($requirement, $satisfier);
	}

	function it_should_satisfy_a_class_with_an_object_that_extends_it()
	{
		$requirement = new Requirement(aClass::class);
		$satisfier = new aSubclass();

		$this->satisfies($requirement, $satisfier)->shouldReturn($satisfier);
	}

	function it_shouldnt_satisfy_a_class_with_an_object_that_doesnt_extend_it()
	{
		$requirement = new Requirement(aSubclass::class);
		$satisfier = new aClass();

		$this->shouldThrow('Guiwoda\Framework\Requirements\RequirementNotMetException')
			->duringSatisfies($requirement, $satisfier);
	}

	function it_should_satisfy_a_class_with_an_object_of_that_class()
	{
		$requirement = new Requirement(aClass::class);
		$satisfier = new aClass();

		$this->satisfies($requirement, $satisfier)->shouldReturn($satisfier);
	}

	function it_shouldnt_satisfy_a_class_with_an_object_of_another_class()
	{
		$requirement = new Requirement(aClass::class);
		$satisfier = new anotherClass();

		$this->shouldThrow('Guiwoda\Framework\Requirements\RequirementNotMetException')
			->duringSatisfies($requirement, $satisfier);
	}
}

interface anInterface {}
abstract class anAbstractClass {}
class anInterfaceImplementation implements anInterface {}
class anAbstractClassImplementation extends anAbstractClass {}
class aClass {}
class aSubclass extends aClass {}
class anotherClass {}

