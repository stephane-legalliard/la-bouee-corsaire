<?php

	namespace AppBundle\Entity;

	use AppBundle\DBAL\Types\TaskLevelType;
	use AppBundle\Entity\User;
	use Doctrine\ORM\Mapping as ORM;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
	use Symfony\Component\Validator\Constraints as Assert;

	/**
	 * Tasks posted by Users
	 *
	 * @ORM\Entity
	 * @ORM\Table(name="tasks")
	 */
	class Task {

		use StatusTrait;

		/**
		 * ID
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
		 * Description
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
		 * Details
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
		 * Location (region or city)
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
		 * Owner
		 *
		 * @ORM\ManyToOne(targetEntity="User")
		 *
		 * @var    User
		 * @access private
		 */
		protected $user;

		/**
		 * Creation date
		 *
		 * @ORM\Column(type="datetimetz")
		 *
		 * @var    DateTime
		 * @access protected
		 */
		protected $date;

		/**
		 * Required level of expertise
		 *
		 * @ORM\Column(type="TaskLevelType", nullable=false, options={"default"="0"})
		 * @DoctrineAssert\Enum(entity="AppBundle\DBAL\Types\TaskLevelType")
		 *
		 * @var    enum $level
		 * @access protected
		 */
		protected $level = TaskLevelType::NONE;

		/**
		 * Return ID
		 *
		 * @return integer
		 */
		public function getId() { return $this->id; }

		/**
		 * Return description
		 *
		 * @return string
		 */
		public function getTitle() { return $this->title; }

		/**
		 * Return details
		 *
		 * @return string
		 */
		public function getDescription() { return $this->description; }

		/**
		 * Return location (region or city)
		 *
		 * @return string
		 */
		public function getLocation() { return $this->location; }

		/**
		 * Return owner
		 *
		 * @return User
		 */
		public function getUser() { return $this->user; }

		/**
		 * Return creation date
		 *
		 * @return \DateTime
		 */
		public function getDate() { return $this->date; }

		/**
		 * Return required level of expertise
		 *
		 * @return string
		 */
		public function getLevel() { return $this->level; }

		/**
		 * Set description
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
		 * Set details
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
		 * Set location (city or region)
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
		 * Set owner
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
		 * Set creation date
		 *
		 * @return Task
		 */
		public function setDate(\DateTime $date) {
			$this->date = $date;
			return $this;
		}

		/**
		 * Set required level of expertise
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setLevel($level) {
			switch ($level) {
				case TaskLevelType::NONE:
				case TaskLevelType::INITIE:
				case TaskLevelType::AVANCE:
				case TaskLevelType::EXPERT:
					$this->level = $level;
					break;
			}

			return $this;
		}

		/**
		 * Build a new Task instance from parameters given in an array
		 *
		 * @param array
		 *
		 * @return Task
		 */
		public static function fromArray($array) {
			$task = new static();
			foreach ($array as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($task, $method)) {
					$task->$method($value);
				}
			}
			return $task;
		}

	}

?>
