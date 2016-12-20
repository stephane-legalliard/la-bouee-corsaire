<?php
	
	namespace AppBundle\Form;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class TaskType extends AbstractType {
		
		/**
		 * @var string
		 */
		private $class;
		
		/**
		 * @param string $class
		 */
		public function __construct($class = 'AppBundle\Entity\Task') {
			$this->class = $class;
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder
			 ->add('title', null, array('label' => 'Titre'))
			 ->add('location', null, array('label' => 'Lieu'))
			 ->add('level', null, array('label' => 'Niveau d’expertise'))
			 ->add('description', null, array('label' => 'Description'));
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults(array(
				'data_class' => $this->class,
				'csrf_token_id' => 'registration',
			));
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function getBlockPrefix() {
			return 'app_user_registration';
		}
		
	}
	
?>
