<?php
	
	namespace AppBundle\Entity;
	
	use AppBundle\Entity\Task;
	use AppBundle\DBAL\Types\ServiceLevelType;
	use Doctrine\ORM\Mapping as ORM;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="services")
	 */
	class Service extends Task {
		
		/**
		 * Level of the User providing the service
		 *
		 * @ORM\Column(type="ServiceLevelType", nullable=false, options={"default"="1"})
		 * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\ServiceLevelType")
		 *
		 * @var    enum $level
		 * @access protected
		 */
		protected $level;
		
		/**
		 * Get level
		 *
		 * @return string
		 */
		public function getLevel() { return $this->level; }
		
		/**
		 * Set level
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setLevel($level) {
			switch ($level) {
				case '1':
				case '2':
				case '3':
					$this->level = $level;
					break;
			}
			
			return $this;
		}
		
		public static function fromArray($array) {
			$service = parent::fromArray($array);
			
			if (isset($array['level'])) {
				$service->setLevel($array['level']);
			}
			
			return $service;
		}
		
	}
	
?>
