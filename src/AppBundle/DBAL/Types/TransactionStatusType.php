<?php

	namespace AppBundle\DBAL\Types;

	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

	/**
	 * Custom DBAL type for ENUM management by Doctrine
	 */
	final class TransactionStatusType extends AbstractEnumType {

		const OPEN      = '0';
		const VALIDATED = '1';
		const DONE      = '2';

		/**
		 * @var array Array of ENUM Values, where ENUM values are keys and their readable versions are values
		 * @static
		 */
		protected static $choices = [
			self::OPEN      => 'Ouverte',
			self::VALIDATED => 'Validée',
			self::DONE      => 'Effectuée',
		];

	}

?>
