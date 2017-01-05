<?php

	namespace Tests\AppBundle\Entity;

	use AppBundle\Entity\User;

	class UserTest extends \PHPUnit_Framework_TestCase {

		/**
		 * @return User
		 */
		protected function getUser() {
			return $this->getMockForAbstractClass('AppBundle\Entity\User');
		}

		public function testUsername() {
			$user = $this->getUser();
			$this->assertNull($user->getUsername());

			$user->setUsername('tony');
			$this->assertSame('tony', $user->getUsername());
		}

		public function testEmail() {
			$user = $this->getUser();
			$this->assertNull($user->getEmail());

			$user->setEmail('tony@mail.org');
			$this->assertSame('tony@mail.org', $user->getEmail());
		}

		public function testName() {
			$user = $this->getUser();
			$this->assertNull($user->getName());

			$user->setName('Tony');
			$this->assertSame('Tony', $user->getName());
		}

		public function testSurname() {
			$user = $this->getUser();
			$this->assertNull($user->getSurname());

			$user->setSurname('Capone');
			$this->assertSame('Capone', $user->getSurname());
		}

		public function testAdress() {
			$user = $this->getUser();
			$this->assertNull($user->getAdress());

			$user->setAdress('12, rue des Lilas\n35000\RENNES');
			$this->assertSame('12, rue des Lilas\n35000\RENNES', $user->getAdress());
		}

		public function testRegion() {
			$user = $this->getUser();
			$this->assertNull($user->getRegion());

			$user->setRegion('Bretagne');
			$this->assertSame('Bretagne', $user->getRegion());
		}

		public function testCity() {
			$user = $this->getUser();
			$this->assertNull($user->getCity());

			$user->setCity('Rennes');
			$this->assertSame('Rennes', $user->getCity());
		}

		public function testPhone() {
			$user = $this->getUser();
			$this->assertNull($user->getPhone());

			$user->setPhone('0612244896');
			$this->assertSame('0612244896', $user->getPhone());
		}

		public function testHours() {
			$user = $this->getUser();
			$this->assertEquals(0, $user->getHoursCredit());
			$this->assertEquals(0, $user->getHoursDebit());
			$this->assertEquals(0, $user->getHours());

			$user->addHours(15);
			$user->subHours(5);
			$this->assertEquals(15, $user->getHoursCredit());
			$this->assertEquals(5, $user->getHoursDebit());
			$this->assertEquals(10, $user->getHours());
		}

		public function testIsPasswordRequestNonExpired() {
			$user = $this->getUser();
			$passwordRequestedAt = new \DateTime('-10 seconds');

			$user->setPasswordRequestedAt($passwordRequestedAt);

			$this->assertSame($passwordRequestedAt, $user->getPasswordRequestedAt());
			$this->assertTrue($user->isPasswordRequestNonExpired(15));
			$this->assertFalse($user->isPasswordRequestNonExpired(5));
		}

		public function testIsPasswordRequestAtCleared() {
			$user = $this->getUser();
			$passwordRequestedAt = new \DateTime('-10 seconds');

			$user->setPasswordRequestedAt($passwordRequestedAt);
			$user->setPasswordRequestedAt(null);

			$this->assertFalse($user->isPasswordRequestNonExpired(15));
			$this->assertFalse($user->isPasswordRequestNonExpired(5));
		}

		public function testTrueHasRole() {
			$user = $this->getUser();
			$defaultrole = User::ROLE_DEFAULT;
			$newrole = 'ROLE_X';
			$this->assertTrue($user->hasRole($defaultrole));
			$user->addRole($defaultrole);
			$this->assertTrue($user->hasRole($defaultrole));
			$user->addRole($newrole);
			$this->assertTrue($user->hasRole($newrole));
		}

		public function testFalseHasRole() {
			$user = $this->getUser();
			$newrole = 'ROLE_X';
			$this->assertFalse($user->hasRole($newrole));
			$user->addRole($newrole);
			$this->assertTrue($user->hasRole($newrole));
		}

	}

?>
