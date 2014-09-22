<?php namespace spec\Guiwoda\DomainRequirements\Responsibles;

use Guiwoda\DomainRequirements\Contracts\Requirement;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CallbackResponsibleSpec
 * @package spec\Guiwoda\DomainRequirements\Responsibles
 * @mixin \Guiwoda\DomainRequirements\Responsibles\CallbackResponsible
 */
class CallbackResponsibleSpec extends ObjectBehavior
{
	function let()
	{
		$this->beConstructedWith('aResponsibility', function(){
			return 'aResponse';
		});
	}

	function it_abides_to_a_contract()
	{
		$this->shouldHaveType('Guiwoda\DomainRequirements\Contracts\Responsible');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\DomainRequirements\Responsibles\CallbackResponsible');
    }

	function it_should_use_a_callback_function_to_resolve_the_requirement(Requirement $requirement)
	{
		$this->satisfy($requirement)->shouldReturn('aResponse');
	}
}
