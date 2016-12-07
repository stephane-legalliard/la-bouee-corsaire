<?php
	
	namespace Tests\AppBundle\Form\Type;
	
	use Tests\AppBundle\Entity\UserTest;
	use AppBundle\Form\RegistrationType;
	use FOS\UserBundle\Tests\Form\Type\ValidatorExtensionTypeTestCase;
	use FOS\UserBundle\Util\LegacyFormHelper;
	
	class RegistrationTypeTest extends ValidatorExtensionTypeTestCase {
		public function testSubmit() {
			$user = new UserTest();
			
			$form = $this->factory->create(LegacyFormHelper::getType('AppBundle\Form\RegistrationType'), $user);
			$formData = array(
				'username'      => 'bar',
				'email'         => 'john@doe.com',
				'plainPassword' => array(
					'first'       => 'test',
					'second'      => 'test',
				),
				'name'          => 'John',
				'surname'       => 'Doe',
				'adress'        => '23, rue d’Aiguillon - 35000 Rennes',
				'region'        => 'Bretagne',
				'city'          => 'Rennes',
				'phone'         => '0000000000',
				'description'   => 'Hello World!',
			);
			$form->submit($formData);
			
			$this->assertTrue($form->isSynchronized());
			$this->assertSame($user, $form->getData());
			$this->assertSame('bar', $user->getUsername());
			$this->assertSame('john@doe.com', $user->getEmail());
			$this->assertSame('test', $user->getPlainPassword());
			$this->assertSame('John', $user->getName());
			$this->assertSame('Doe', $user->getSurname());
			$this->assertSame('23, rue d’Aiguillon - 35000 Rennes', $user->getAdress());
			$this->assertSame('Bretagne', $user->getRegion());
			$this->assertSame('Rennes', $user->getCity());
			$this->assertSame('0000000000', $user->getPhone());
			$this->assertSame('Hello World!', $user->getDescription());
		}
		
		/**
		 * @return array
		 */
		protected function getTypes() {
			return array_merge(parent::getTypes(), array(
				new RegistrationType('Tests\AppBundle\Entity\UserTest'),
			));
		}
	}
	
?>
