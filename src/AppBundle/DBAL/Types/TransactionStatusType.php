<?php
	
	namespace AppBundle\DBAL\Types;
	
	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
	
	final class TransactionStatusType extends AbstractEnumType {
		const OPEN      = '0';
		const VALIDATED = '1';
		const DONE      = '2';
		
		protected static $choices = [
			self::OPEN      => 'Ouverte',
			self::VALIDATED => 'Validée',
			self::DONE      => 'Effectuée',
		];
	}
	
?>
