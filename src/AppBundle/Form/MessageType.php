<?php
	
	namespace AppBundle\Form;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class MessageType extends AbstractType {
		
		/**
		 * @var string
		 */
		private $class;
		
		/**
		 * @param string $class
		 */
		public function __construct($class = 'AppBundle\Entity\Message') {
			$this->class = $class;
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder
				->add('content', null, array(
					'translation_domain' => false,
					'label' => 'Rédigez votre message…'
				));
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
			return 'message_new';
		}
		
	}
	
?>
