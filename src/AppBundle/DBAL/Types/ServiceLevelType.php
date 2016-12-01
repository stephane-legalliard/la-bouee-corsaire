<?php
	
	namespace AppBundle\DBAL\Types;
	
	use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;
	
	final class ServiceLevelType extends AbstractEnumType {
		const INITIE = '1';
		const AVANCE = '2';
		const EXPERT = '3';
		
		protected static $choices = [
			self::INITIE => 'Initié',
			self::AVANCE => 'Avancé',
			self::EXPERT => 'Expert'
		];
	}
	
?>
