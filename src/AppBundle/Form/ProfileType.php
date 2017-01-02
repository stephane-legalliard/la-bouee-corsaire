<?php

	namespace AppBundle\Form;

	use Symfony\Component\OptionsResolver\OptionsResolver;
	use AppBundle\Form\UserType;

	/**
	 * Form used for User edition by the account owner
	 */
	class ProfileType extends UserType {

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
