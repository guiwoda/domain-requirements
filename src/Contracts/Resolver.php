<?php namespace Guiwoda\Framework\Contracts;

interface Resolver
{
	/**
	 * @param Requirement $requirement
	 * @param Responsible $responsible
	 *
	 * @return boolean
	 */
	public function satisfies(Requirement $requirement, Responsible $responsible);
} 