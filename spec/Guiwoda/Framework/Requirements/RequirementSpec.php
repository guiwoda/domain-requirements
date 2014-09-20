<?php namespace spec\Guiwoda\Framework\Requirements;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequirementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
	    $this->beConstructedWith('spec\Guiwoda\Framework\MockRequiredInterface', ['some' => 'parameters', 'array']);
        $this->shouldHaveType('Guiwoda\Framework\Requirements\Requirement');
    }
}