<?php namespace spec\Guiwoda\DomainRequirements\Requirements;

use Guiwoda\DomainRequirements\Contracts\Requirement;
use Guiwoda\DomainRequirements\Contracts\Responsible;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ResolverSpec
 * @package spec\Guiwoda\DomainRequirements\Requirements
 * @mixin \Guiwoda\DomainRequirements\Requirements\Resolver
 */
class ResolverSpec extends ObjectBehavior
{
	function it_abides_to_a_contract()
	{
		$this->shouldHaveType('Guiwoda\DomainRequirements\Contracts\Resolver');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\DomainRequirements\Requirements\Resolver');
    }

	function it_should_satisfy_an_interface_with_an_object_that_implements_it(Requirement $requirement, Responsible $responsible)
	{
		$responsible->getResponsibility()->willReturn(anInterfaceImplementation::class);
		$requirement->getClass()->willReturn(anInterface::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(true);
	}

	function it_shouldnt_satisfy_an_interface_with_an_object_that_doesnt_implement_it(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(anInterface::class);
		$responsible->getResponsibility()->willReturn(aClass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(false);
	}

	function it_should_satisfy_an_abstract_class_with_an_object_that_implements_it(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(anAbstractClass::class);
		$responsible->getResponsibility()->willReturn(anAbstractClassImplementation::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(true);
	}

	function it_shouldnt_satisfy_an_abstract_class_with_an_object_that_doesnt_implement_it(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(anAbstractClass::class);
		$responsible->getResponsibility()->willReturn(aClass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(false);
	}

	function it_should_satisfy_a_class_with_an_object_that_extends_it(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(aClass::class);
		$responsible->getResponsibility()->willReturn(aSubclass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(true);
	}

	function it_shouldnt_satisfy_a_class_with_an_object_that_doesnt_extend_it(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(aSubclass::class);
		$responsible->getResponsibility()->willReturn(aClass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(false);
	}

	function it_should_satisfy_a_class_with_an_object_of_that_class(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(aClass::class);
		$responsible->getResponsibility()->willReturn(aClass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(true);
	}

	function it_shouldnt_satisfy_a_class_with_an_object_of_another_class(Requirement $requirement, Responsible $responsible)
	{
		$requirement->getClass()->willReturn(aClass::class);
		$responsible->getResponsibility()->willReturn(anotherClass::class);

		$this->satisfies($requirement, $responsible)->shouldReturn(false);
	}
}

interface anInterface {}
abstract class anAbstractClass {}
class anInterfaceImplementation implements anInterface {}
class anAbstractClassImplementation extends anAbstractClass {}
class aClass {}
class aSubclass extends aClass {}
class anotherClass {}

