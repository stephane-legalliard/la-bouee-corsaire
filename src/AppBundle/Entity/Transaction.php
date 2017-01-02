<?php

	namespace AppBundle\Entity;

	use AppBundle\DBAL\Types\TransactionStatusType;
	use AppBundle\Entity\Message;
	use AppBundle\Entity\Task;
	use AppBundle\Entity\User;
	use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;
	use Doctrine\ORM\Mapping as ORM;

	/**
	 * Ongoing and past Transactions between Users
	 *
	 * @ORM\Entity
	 * @ORM\Table(name="transactions")
	 */
	class Transaction {

		/**
		 * ID
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
		protected $status = TransactionStatusType::OPEN;

		/**
		 * Associated Task estimated duration
		 *
		 * @ORM\Column(type="float", scale=2, nullable=false, options={"unsigned"=true, "default"=0})
		 *
		 * @var    float $duration
		 * @access protected
		 */
		protected $duration;

		/**
		 * Constructor, set Doctrine Collections
		 */
		public function __construct() {
			$this->users = new ArrayCollection();
			$this->messages = new ArrayCollection();
		}

		/**
		 * Return ID
		 *
		 * @return integer
		 */
		public function getId() { return $this->id; }

		/**
		 * Return associated Task
		 *
		 * @return Task
		 */
		public function getTask() { return $this->task; }

		/**
		 * Return associated Users
		 *
		 * @return Collection
		 */
		public function getUsers() { return $this->users; }

		/**
		 * Return associated Messages
		 *
		 * @return Collection
		 */
		public function getMessages() { return $this->messages; }

		/**
		 * Return current status
		 *
		 * @return string
		 */
		public function getStatus() { return $this->status; }

		/**
		 * Return associated Task estimated duration
		 *
		 * @return float
		 */
		public function getDuration() { return $this->duration; }

		/**
		 * Set associated Task
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
		 * Add an User to the list of associated Users
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
		 * Remove an User from the list of associated Users
		 *
		 * @param User $user
		 *
		 * @return Transaction
		 */
		public function removeUser(User $user) {
			$this->users->removeElement($user);
			return $this;
		}

		/**
		 * Add a Message to the list of associated Messages
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
		 * Remove a Message from the list of associated Messages
		 *
		 * @param Message $message
		 *
		 * @return Transaction
		 */
		public function removeMessage(Message $message) {
			$this->messages->removeElement($message);
			return $this;
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
		 * Set associated Task estimated duration
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

		/**
		 * Set current status to VALIDATED
		 *
		 * @return Transaction
		 */
		public function validate() {
			$this->setStatus(TransactionStatusType::VALIDATED);
			// Disable associated Task on Transaction validation
			$this->getTask()->disable();
			return $this;
		}

		/**
		 * Set current status to DONE
		 *
		 * @return Transaction
		 */
		public function close() {
			$this->setStatus(TransactionStatusType::DONE);
			return $this;
		}

		/**
		 * Set current status to OPEN
		 *
		 * @return Transaction
		 */
		public function open() {
			$this->setStatus(TransactionStatusType::OPEN);
			return $this;
		}

	}

?>
