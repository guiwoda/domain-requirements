<?php namespace Guiwoda\Framework\Contracts;

interface ChainOfCommand
{
	public function delegateTo(ChainOfCommand $object);
} 