<?php
	
	namespace AppBundle\Entity;
	
	use AppBundle\Entity\Task;
	use AppBundle\DBAL\Types\NeedLevelType;
	use Doctrine\ORM\Mapping as ORM;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="needs")
	 */
	class Need extends Task {
		
		/**
		 * Level of the User providing the service
		 *
		 * @ORM\Column(type="NeedLevelType", nullable=false, options={"default"="0"})
		 * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\NeedLevelType")
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
				case '0':
				case '1':
				case '2':
				case '3':
					$this->level = $level;
					break;
			}
			
			return $this;
		}
		
	}
	
?>
