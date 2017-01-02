<?php

	namespace Tests\AppBundle\Entity;

	use AppBundle\DBAL\Types\TransactionStatusType;
	use AppBundle\Entity\Message;
	use AppBundle\Entity\Task;
	use AppBundle\Entity\Transaction;
	use AppBundle\Entity\User;

	class TransactionTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @return Message
		 */
		protected function getMessage() {
			return $this->getMockForAbstractClass('AppBundle\Entity\Message');
		}

		/**
		 * @return Task
		 */
		protected function getTask() {
			return $this->getMockForAbstractClass('AppBundle\Entity\Task');
		}

		/**
		 * @return Transaction
		 */
		protected function getTransaction() {
			return $this->getMockForAbstractClass('AppBundle\Entity\Transaction');
		}

		/**
		 * @return User
		 */
		protected function getUser() {
			return $this->getMockForAbstractClass('AppBundle\Entity\User');
		}

		public function testTask() {
			$transaction = $this->getTransaction();
			$this->assertNull($transaction->getTask());

			$task = $this->getTask();
			$transaction->setTask($task);
			$this->assertSame($task, $transaction->getTask());
		}

		public function testUsers() {
			$transaction = $this->getTransaction();
			$this->assertNull($transaction->getUsers()[0]);

			$user = $this->getUser();
			$transaction->addUser($user);
			$this->assertSame($user, $transaction->getUsers()[0]);

			$transaction->RemoveUser($user);
			$this->assertNull($transaction->getUsers()[0]);
		}

		public function testMessages() {
			$transaction = $this->getTransaction();
			$this->assertNull($transaction->getMessages()[0]);

			$message = $this->getMessage();
			$transaction->addMessage($message);
			$this->assertSame($message, $transaction->getMessages()[0]);

			$transaction->RemoveMessage($message);
			$this->assertNull($transaction->getMessages()[0]);
		}

		public function testStatus() {
			$transaction = $this->getTransaction();
			$this->assertSame(TransactionStatusType::OPEN, $transaction->getStatus());

			$task = $this->getTask();
			$transaction->setTask($task);

			$transaction->validate();
			$this->assertSame(TransactionStatusType::VALIDATED, $transaction->getStatus());

			$transaction->close();
			$this->assertSame(TransactionStatusType::DONE, $transaction->getStatus());

			$transaction->open();
			$this->assertSame(TransactionStatusType::OPEN, $transaction->getStatus());
		}

		public function testDuration() {
			$transaction = $this->getTransaction();
			$this->assertEquals(0, $transaction->getDuration());

			$transaction->setDuration(5);
			$this->assertEquals(5, $transaction->getDuration());
		}

	}

?>
