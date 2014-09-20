<?php namespace spec\Guiwoda\Framework\Requirements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequirementSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('spec\Guiwoda\Framework\MockRequiredInterface', ['some' => 'parameters', 'array']);
	}

	function it_abides_to_a_contract()
	{
		$this->shouldHaveType('Guiwoda\Framework\Contracts\Requirement');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\Framework\Requirements\Requirement');
    }
}