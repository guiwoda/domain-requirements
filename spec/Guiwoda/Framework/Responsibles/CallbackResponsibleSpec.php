<?php namespace spec\Guiwoda\Framework\Responsibles;

use Guiwoda\Framework\Contracts\Requirement;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class CallbackResponsibleSpec
 * @package spec\Guiwoda\Framework\Responsibles
 * @mixin \Guiwoda\Framework\Responsibles\CallbackResponsible
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
		$this->shouldHaveType('Guiwoda\Framework\Contracts\Responsible');
	}

    function it_is_initializable()
    {
        $this->shouldHaveType('Guiwoda\Framework\Responsibles\CallbackResponsible');
    }

	function it_should_use_a_callback_function_to_resolve_the_requirement(Requirement $requirement)
	{
		$this->satisfy($requirement)->shouldReturn('aResponse');
	}
}
