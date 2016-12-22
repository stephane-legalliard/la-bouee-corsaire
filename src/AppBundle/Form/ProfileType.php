<?php

	namespace AppBundle\Form;

	use Symfony\Component\OptionsResolver\OptionsResolver;
	use AppBundle\Form\UserType;

	class ProfileType extends UserType {

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
			return 'fos_user_profile';
		}

	}

?>
