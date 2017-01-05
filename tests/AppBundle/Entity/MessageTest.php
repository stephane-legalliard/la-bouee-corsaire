<?php

	namespace Tests\AppBundle\Entity;

	use AppBundle\Entity\Message;
	use AppBundle\Entity\Transaction;
	use AppBundle\Entity\User;

	class MessageTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @return Message
		 */
		protected function getMessage() {
			return $this->getMockForAbstractClass('AppBundle\Entity\Message');
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

		public function testContent() {
			$message = $this->getMessage();
			$this->assertNull($message->getContent());

			$message->setContent('Hello World!');
			$this->assertSame('Hello World!', $message->getContent());
		}

		public function testDate() {
			$message = $this->getMessage();
			$this->assertNull($message->getDate());

			$date = new \DateTime();
			$message->setDate($date);
			$this->assertSame($date, $message->getDate());
		}

		public function testAuthor() {
			$message = $this->getMessage();
			$this->assertNull($message->getAuthor());

			$user = $this->getUser();
			$message->setAuthor($user);
			$this->assertSame($user, $message->getAuthor());
		}

		public function testDest() {
			$message = $this->getMessage();
			$this->assertNull($message->getDest());

			$user = $this->getUser();
			$message->setDest($user);
			$this->assertSame($user, $message->getDest());
		}

		public function testTransaction() {
			$message = $this->getMessage();
			$this->assertNull($message->getTransaction());

			$transaction = $this->getTransaction();
			$message->setTransaction($transaction);
			$this->assertSame($transaction, $message->getTransaction());
		}

		public function testDuration() {
			$message = $this->getMessage();
			$this->assertEquals(0, $message->getDuration());

			$message->setDuration(5);
			$this->assertEquals(5, $message->getDuration());
		}

		public function testValidation() {
			$message = $this->getMessage();
			$this->assertFalse($message->getValidation());

			$message->setValidation(true);
			$this->assertTrue($message->getValidation());
		}

	}

?>
