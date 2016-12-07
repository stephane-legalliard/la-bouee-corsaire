<?php
	
	namespace Tests\AppBundle\Form;
	
	use AppBundle\Form\ServiceType;
	use AppBundle\Entity\Service;
	use Symfony\Component\Form\PreloadedExtension;
	use Symfony\Component\Form\Test\TypeTestCase;
	
	class ServiceTypeTest extends TypeTestCase {
		
		private $entityManager;
		
		protected function setUp() {
			$this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
			parent::setUp();
		}
		
		protected function getExtensions() {
			$type = new Service($this->entityManager);
			
			return array(
				new PreloadedExtension(array($type), array()),
			);
		}
		
		public function testSubmitValidData() {
			
			$formData = array(
				'title'       => 'Test',
				'location'    => 'Rennes',
				'level'       => '1',
				'description' => 'Hello World!',
			);
			
			$form = $this->factory->create(ServiceType::class);
			
			$service = Service::fromArray($formData);
			
			$form->submit($formData);
			
			$this->assertTrue($form->isSynchronized());
			$this->assertEquals($service, $form->getData());
			
			$view = $form->createView();
			$children = $view->children;
			
			foreach (array_keys($formData) as $key) {
				$this->assertArrayHasKey($key, $children);
			}
			
		}
		
	}
	
?>
