<?php namespace Guiwoda\Framework\Contracts;

interface Responsible
{
	/**
	 * @return string
	 */
	public function getResponsibility();

	/**
	 * @param Requirement $requirement
	 *
	 * @return mixed The object that it's responsible of returning
	 */
	public function satisfy(Requirement $requirement);
}