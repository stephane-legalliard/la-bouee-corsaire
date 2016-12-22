<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use AppBundle\Form\UserType;

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
		 * {@inheritdoc}
		 */
		public function configureOptions(OptionsResolver $resolver) {
			$resolver->setDefaults(array(
				'data_class' => $this->class,
				'csrf_token_id' => 'profile',
			));
		}

		/**
		 * {@inheritdoc}
		 */
		public function getBlockPrefix() {
			return 'fos_user_profile_admin';
		}
	}

?>
