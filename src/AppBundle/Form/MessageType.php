<?php
	
	namespace AppBundle\Form;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;

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
				->add('duration', IntegerType::class, array(
					'translation_domain' => false,
					'label' => 'Durée estimée (en heures)',
					'empty_data' => '0',
					'required' => false,
				))
				->add('content', TextareaType::class, array(
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
