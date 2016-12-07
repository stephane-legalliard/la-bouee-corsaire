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
		 * Number of hours needed to fullfil the Need
		 *
		 * @ORM\Column(type="float", scale=2, nullable=false, options={"unsigned"=true, "default"=0})
		 *
		 * @var    float
		 * @access protected
		 */
		protected $hours = 0;
		
		/**
		 * Get level
		 *
		 * @return string
		 */
		public function getLevel() { return $this->level; }
		
		/**
		 * Get hours
		 *
		 * @return float
		 */
		public function getHours() { return $this->hours; }
		
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
		
		/**
		 * Set hours
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function setHours($hours)
		{
			$hours = (float) $hours;
			
			if ($hours >= 0) {
				$this->hours = $hours;
			}
			
			return $this;
		}
		
		public static function fromArray($array) {
			$need = parent::fromArray($array);
			
			if (isset($array['level'])) {
				$need->setLevel($array['level']);
			}
			
			if (isset($array['hours'])) {
				$need->setHours($array['hours']);
			}
			
			return $need;
		}
		
	}
	
?>
