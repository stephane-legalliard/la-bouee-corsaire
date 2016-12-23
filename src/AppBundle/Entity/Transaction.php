<?php

	namespace AppBundle\Entity;

	use AppBundle\Entity\Message;
	use AppBundle\Entity\Task;
	use AppBundle\Entity\User;
	use AppBundle\DBAL\Types\TransactionStatusType;
	use Doctrine\ORM\Mapping as ORM;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;

	/**
	 * @ORM\Entity
	 * @ORM\Table(name="transactions")
	 */
	class Transaction {

		/**
		 * Transaction ID
		 *
		 * @ORM\Column(type="integer", options={"unsigned"=true})
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 *
		 * @var    int $id
		 * @access protected
		 */
		protected $id;

		/**
		 * Associated Task
		 *
		 * @ORM\ManyToOne(targetEntity="Task")
		 *
		 * @var    Task $task
		 * @access private
		 */
		protected $task;

		/**
		 * Associated Users
		 *
		 * @ORM\ManyToMany(targetEntity="User")
		 *
		 * @var    User[] $users
		 * @access private
		 */
		protected $users;

		/**
		 * Associated Messages
		 *
		 * @ORM\OneToMany(targetEntity="Message", mappedBy="transaction")
		 *
		 * @var    Message[] $users
		 * @access private
		 */
		protected $messages;

		/**
		 * Current status
		 *
		 * @ORM\Column(type="TransactionStatusType", nullable=false, options={"default"="0"})
		 * @DoctrineAssert\Enum(entity="TransactionStatusType")
		 *
		 * @var    enum $status
		 * @access protected
		 */
		protected $status;

		/**
		 * Estimated duration of the associated Task
		 *
		 * @ORM\Column(type="float", scale=2, nullable=false, options={"unsigned"=true, "default"=0})
		 *
		 * @var    float $duration
		 * @access protected
		 */
		protected $duration;

		/**
		 * Constructor
		 */
		public function __construct() {
			$this->users = new ArrayCollection();
			$this->messages = new ArrayCollection();
		}

		/**
		 * Get id
		 *
		 * @return integer
		 */
		public function getId() { return $this->id; }

		/**
		 * Get task
		 *
		 * @return Task
		 */
		public function getTask() { return $this->task; }

		/**
		 * Get users
		 *
		 * @return Collection
		 */
		public function getUsers() { return $this->users; }

		/**
		 * Get messages
		 *
		 * @return Collection
		 */
		public function getMessages() { return $this->messages; }

		/**
		 * Get current status
		 *
		 * @return string
		 */
		public function getStatus() { return $this->status; }

		/**
		 * Get estimated duration of the associated Task
		 *
		 * @return float
		 */
		public function getDuration() { return $this->duration; }

		/**
		 * Set task
		 *
		 * @param Task $task
		 *
		 * @return Transaction
		 */
		public function setTask(Task $task = null) {
			$this->task = $task;
			return $this;
		}

		/**
		 * Add user
		 *
		 * @param User $user
		 *
		 * @return Transaction
		 */
		public function addUser(User $user) {
			$this->users[] = $user;
			return $this;
		}

		/**
		 * Remove user
		 *
		 * @param User $user
		 */
		public function removeUser(User $user) {
			$this->users->removeElement($user);
		}

		/**
		 * Add message
		 *
		 * @param Message $message
		 *
		 * @return Transaction
		 */
		public function addMessage(Message $message) {
			$this->messages[] = $message;
			return $this;
		}

		/**
		 * Remove message
		 *
		 * @param Message $message
		 */
		public function removeMessage(Message $message) {
			$this->messages->removeElement($message);
		}

		/**
		 * Set current status
		 *
		 * @param string
		 *
		 * @return Transaction
		 */
		public function setStatus($status) {
			switch ($status) {
				case TransactionStatusType::OPEN:
				case TransactionStatusType::VALIDATED:
				case TransactionStatusType::DONE:
					$this->status = $status;
					break;
			}
			return $this;
		}

		/**
		 * Set estimated duration of the associated Task
		 *
		 * @param float
		 *
		 * @return Transaction
		 */
		public function setDuration($duration) {
			$duration = (float) $duration;
			if ($duration >= 0) {
				$this->duration = $duration;
			}
			return $this;
		}

		public function validate() {
			$this->setStatus(TransactionStatusType::VALIDATED);
			// Disable associated Task on Transaction validation
			$this->getTask()->disable();
			return $this;
		}

		public function close() {
			$this->setStatus(TransactionStatusType::DONE);
			return $this;
		}

		public function open() {
			$this->setStatus(TransactionStatusType::OPEN);
			return $this;
		}

	}

?>
