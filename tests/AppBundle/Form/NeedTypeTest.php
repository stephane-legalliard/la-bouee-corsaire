<?php
	
	namespace Tests\AppBundle\Form;
	
	use AppBundle\Form\NeedType;
	use AppBundle\Entity\Need;
	use Symfony\Component\Form\PreloadedExtension;
	use Symfony\Component\Form\Test\TypeTestCase;
	
	class NeedTypeTest extends TypeTestCase {
		
		private $entityManager;
		
		protected function setUp() {
			$this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
			parent::setUp();
		}
		
		protected function getExtensions() {
			$type = new Need($this->entityManager);
			
			return array(
				new PreloadedExtension(array($type), array()),
			);
		}
		
		public function testSubmitValidData() {
			
			$formData = array(
				'title'       => 'Test',
				'location'    => 'Rennes',
				'hours'       => 0,
				'level'       => '0',
				'status'      => 'OP',
				'description' => 'Hello World!',
			);
			
			$form = $this->factory->create(NeedType::class);
			
			$need = Need::fromArray($formData);
			
			$form->submit($formData);
			
			$this->assertTrue($form->isSynchronized());
			$this->assertEquals($need, $form->getData());
			
			$view = $form->createView();
			$children = $view->children;
			
			foreach (array_keys($formData) as $key) {
				$this->assertArrayHasKey($key, $children);
			}
			
		}
		
	}
	
?>
