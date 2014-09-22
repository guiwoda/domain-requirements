<?php namespace Guiwoda\DomainRequirements\Contracts;

interface Requirement
{
	/**
	 * @return array
	 */
	public function getParameters();

	/**
	 * @return string
	 */
	public function getClass();
} 