<?php

	namespace AppBundle\DBAL\Types;

	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

	/**
	 * Custom DBAL type for ENUM management by Doctrine
	 */
	final class TaskLevelType extends AbstractEnumType {

		const NONE   = '0';
		const INITIE = '1';
		const AVANCE = '2';
		const EXPERT = '3';

		/**
		 * @var array Array of ENUM Values, where ENUM values are keys and their readable versions are values
		 * @static
		 */
		protected static $choices = [
			self::NONE   => 'Non spécifié',
			self::INITIE => 'Initié',
			self::AVANCE => 'Avancé',
			self::EXPERT => 'Expert'
		];

	}

?>
