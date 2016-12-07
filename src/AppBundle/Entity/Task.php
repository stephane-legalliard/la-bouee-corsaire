<?php
	
	namespace AppBundle\Entity;
	
	use AppBundle\DBAL\Types\TaskStatusType;
	use AppBundle\Entity\User;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Validator\Constraints as Assert;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
	
	/**
	 * @ORM\MappedSuperclass
	 */
	class Task {
		/**
		 * Task ID
		 *
		 * @ORM\Column(type="integer", options={"unsigned"=true})
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 *
		 * @var    int
		 * @access protected
		 */
		protected $id;
		
		/**
		 * Task title
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer un titre.")
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="Le titre est trop court.",
		 * 	maxMessage="Le titre est trop long.",
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $title;
		
		/**
		 * Task text description
		 *
		 * @ORM\Column(type="text", length=255)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer une description.")
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=255,
		 * 	minMessage="La description est trop courte.",
		 * 	maxMessage="La description est trop longue.",
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $description;
		
		/**
		 * Task region/city
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer une localisation.")
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="La localisation est trop courte.",
		 * 	maxMessage="La localisation est trop longue.",
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $location;
		
		/**
		 * Task status
		 *
		 * @ORM\Column(type="TaskStatusType", nullable=false, options={"default"="OP"})
		 * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\TaskStatusType")
		 *
		 * @var    enum
		 * @access protected
		 */
		protected $status;
		
		/**
		 * User who created the Task
		 *
		 * @ORM\ManyToOne(targetEntity="User")
		 *
		 * @var    User
		 * @access private
		 */
		protected $user;
		
		/**
		 * Category of the Task
		 *
		 * @var    Category
		 * @access private
		 */
		protected $category;
		
		/**
		 * Date of Task creation
		 *
		 * @ORM\Column(type="datetimetz")
		 *
		 * @var    DateTime
		 * @access protected
		 */
		protected $date;
		
		/**
		 * Get id
		 *
		 * @return integer
		 */
		public function getId() { return $this->id; }
		
		/**
		 * Get title
		 *
		 * @return string
		 */
		public function getTitle() { return $this->title; }
		
		/**
		 * Get description
		 *
		 * @return string
		 */
		public function getDescription() { return $this->description; }
		
		/**
		 * Get location
		 *
		 * @return string
		 */
		public function getLocation() { return $this->location; }
		
		/**
		 * Get status
		 *
		 * @return string
		 */
		public function getStatus() { return $this->status; }
		
		/**
		 * Get User
		 *
		 * @return User
		 */
		public function getUser() { return $this->user; }
		
		/**
		 * Get Category
		 *
		 * @return Category
		 */
		public function getCategory() { return $this->category; }
		
		/**
		 * Set title
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setTitle($title) {
			$title = (string) $title;
			
			$length = strlen($title);
			if ($length >= 3 && $length <= 100) {
				$this->title = $title;
			}
			
			return $this;
		}
		
		/**
		 * Set description
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setDescription($description) {
			$description = (string) $description;
			
			$length = strlen($description);
			if ($length >= 3 && $length <= 255) {
				$this->description = $description;
			}
			
			return $this;
		}
		
		/**
		 * Set location
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setLocation($location) {
			$location = (string) $location;
			
			$length = strlen($location);
			if ($length >= 3 && $length <= 100) {
				$this->location = $location;
			}
			
			return $this;
		}
		
		/**
		 * Set status
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setStatus($status) {
			switch ($status) {
				case 'OP':
				case 'PE':
				case 'VA':
				case 'DO':
				case 'DI':
					$this->status = $status;
					break;
			}
			
			return $this;
		}
		
		/**
		 * Set User
		 *
		 * @param User
		 *
		 * @return Task
		 */
		public function setUser(User $user) {
			$this->user = $user;
			return $this;
		}
		
		/**
		 * Set date
		 *
		 * @return Task
		 */
		public function setDate(\DateTime $date) {
			$this->date = $date;
			return $this;
		}
		
		public function isDisabled() {
			return ($this->getStatus() === 'DI');
		}
		
		public static function fromArray($array) {
			$task = new static();
			
			if (isset($array['title'])) {
				$task->setTitle($array['title']);
			}
			
			if (isset($array['description'])) {
				$task->setDescription($array['description']);
			}
			
			if (isset($array['location'])) {
				$task->setLocation($array['location']);
			}
			
			if (isset($array['status'])) {
				$task->setStatus($array['status']);
			}
			
			return $task;
		}
		
	}
	
?>
