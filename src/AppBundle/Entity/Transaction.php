<?php

	namespace AppBundle\Entity;

	use AppBundle\Entity\Message;
	use AppBundle\Entity\Task;
	use AppBundle\Entity\User;
	use Doctrine\ORM\Mapping as ORM;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;

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
		 * @ORM\OneToMany(targetEntity="Message", mappedBy="message")
		 *
		 * @var    Message[] $users
		 * @access private
		 */
		protected $messages;

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

	}

?>
