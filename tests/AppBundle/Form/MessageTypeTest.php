<?php

	namespace Tests\AppBundle\Form;

	use AppBundle\Form\MessageType;
	use AppBundle\Entity\Message;
	use Symfony\Component\Form\PreloadedExtension;
	use Symfony\Component\Form\Test\TypeTestCase;

	class MessageTypeTest extends TypeTestCase {

		private $entityManager;

		protected function setUp() {
			$this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
			parent::setUp();
		}

		protected function getExtensions() {
			$type = new Message($this->entityManager);

			return array(
				new PreloadedExtension(array($type), array()),
			);
		}

		public function testSubmitValidData() {

			$formData = array(
				'duration' => '5',
				'content'  => 'Hello World!',
			);

			$form = $this->factory->create(MessageType::class);

			$task = Message::fromArray($formData);

			$form->submit($formData);

			$this->assertTrue($form->isSynchronized());
			$this->assertEquals($task, $form->getData());

			$view = $form->createView();
			$children = $view->children;

			foreach (array_keys($formData) as $key) {
				$this->assertArrayHasKey($key, $children);
			}

		}

	}

?>
