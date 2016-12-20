<?php
	
	namespace Tests\AppBundle\Form;
	
	use AppBundle\Form\TaskType;
	use AppBundle\Entity\Task;
	use Symfony\Component\Form\PreloadedExtension;
	use Symfony\Component\Form\Test\TypeTestCase;
	
	class TaskTypeTest extends TypeTestCase {
		
		private $entityManager;
		
		protected function setUp() {
			$this->entityManager = $this->getMockBuilder('Doctrine\Common\Persistence\ObjectManager')->getMock();
			parent::setUp();
		}
		
		protected function getExtensions() {
			$type = new Task($this->entityManager);
			
			return array(
				new PreloadedExtension(array($type), array()),
			);
		}
		
		public function testSubmitValidData() {
			
			$formData = array(
				'title'       => 'Test',
				'location'    => 'Rennes',
				'level'       => '0',
				'description' => 'Hello World!',
			);
			
			$form = $this->factory->create(TaskType::class);
			
			$task = Task::fromArray($formData);
			
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
