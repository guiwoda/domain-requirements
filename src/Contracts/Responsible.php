<?php namespace Guiwoda\Framework\Contracts;

interface Responsible extends ChainOfCommand
{
	/**
	 * @return string
	 */
	public function isResponsibleFor();

	/**
	 * @param Requirement $requirement
	 *
	 * @return mixed The object that it's responsible of returning
	 */
	public function satisfy(Requirement $requirement);
}