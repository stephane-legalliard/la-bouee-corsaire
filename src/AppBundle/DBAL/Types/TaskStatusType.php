<?php
	
	namespace AppBundle\DBAL\Types;
	
	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
	
	final class TaskStatusType extends AbstractEnumType {
		const OPEN      = 'OP';
		const PENDING   = 'PE';
		const VALIDATED = 'VA';
		const DONE      = 'DO';
		const DISABLED  = 'DI';
		
		protected static $choices = [
			self::OPEN      => 'Ouverte',
			self::PENDING   => 'En discussion',
			self::VALIDATED => 'Validée',
			self::DONE      => 'Effectuée',
			self::DISABLED  => 'Désactivée'
		];
	}
	
?>
