<?php namespace spec\Guiwoda\DomainRequirements\Requirements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequirementSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('spec\Guiwoda\DomainRequirements\MockRequiredInterface', ['some' => 'parameters', 'array']);
	}

	function it_abides_to_a_contract()
	{
		$this->shouldHaveType('Guiwoda\DomainRequirements\Contracts\Requirement');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\DomainRequirements\Requirements\Requirement');
    }
}