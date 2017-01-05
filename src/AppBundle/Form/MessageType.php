<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;

	/**
	 * Form used to generate Messages
	 */
	class MessageType extends AbstractType {

		/**
		 * Associated class
		 *
		 * @var string
		 */
		private $class;

		/**
		 * Contruct, set the associated class
		 *
		 * @param string $class
		 */
		public function __construct($class = 'AppBundle\Entity\Message') {
			$this->class = $class;
		}

		/**
		 * Builds the form.
		 *
		 * This method is called for each type in the hierarchy starting from the
		 * top most type. Type extensions can further modify the form.
		 *
		 * @param FormBuilderInterface $builder The form builder
		 * @param array                $options The options
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$builder
				->add('duration', IntegerType::class, [
					'translation_domain' => false,
					'label' => 'Durée estimée (en heures)',
					'empty_data' => '0',
					'required' => false,
				])
				->add('content', TextareaType::class, [
					'translation_domain' => false,
					'label' => 'Rédigez votre message…'
				])
				->add('validation', CheckboxType::class, [
					'translation_domain' => false,
					'label' => 'Valider la transaction'
				]);
		}

		/**
		 * Configures the options for this type.
		 *
		 * @param OptionsResolver $resolver The resolver for the options
		 */
		public function configureOptions(OptionsResolver $resolver) {
			$resolver->setDefaults([
				'data_class' => $this->class,
			]);
		}

	}

?>
