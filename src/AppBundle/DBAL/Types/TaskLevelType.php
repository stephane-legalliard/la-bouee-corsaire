<?php
	
	namespace AppBundle\DBAL\Types;
	
	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
	
	final class TaskLevelType extends AbstractEnumType {
		const NONE   = '0';
		const INITIE = '1';
		const AVANCE = '2';
		const EXPERT = '3';
		
		protected static $choices = [
			self::NONE   => 'Non spécifié',
			self::INITIE => 'Initié',
			self::AVANCE => 'Avancé',
			self::EXPERT => 'Expert'
		];
	}
	
?>
