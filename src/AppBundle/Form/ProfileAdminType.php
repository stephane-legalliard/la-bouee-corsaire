<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use AppBundle\Form\UserType;

	/**
	 * Form used for User edition by the administrator
	 */
	class ProfileAdminType extends UserType {

		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			parent::buildForm($builder, $options);
			$builder
				->add('username', null, array(
					'translation_domain' => 'FOSUserBundle',
					'label' => 'form.username',
				))
				->add('hoursCredit', null, array(
					'translation_domain' => false,
					'label' => 'Crédit horaire',
				))
				->add('hoursDebit', null, array(
					'translation_domain' => false,
					'label' => 'Débit horaire',
				));
		}

		/**
		 * Configures the options for this type.
		 *
		 * @param OptionsResolver $resolver The resolver for the options
		 */
		public function configureOptions(OptionsResolver $resolver) {
			$resolver->setDefaults(array(
				'data_class' => $this->class,
				'csrf_token_id' => 'profile',
			));
		}

	}

?>
