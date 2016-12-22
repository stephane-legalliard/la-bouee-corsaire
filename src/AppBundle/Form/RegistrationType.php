<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use FOS\UserBundle\Util\LegacyFormHelper;
	use AppBundle\Form\UserType;

	class RegistrationType extends UserType {

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
				->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
					'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
					'options' => array('translation_domain' => 'FOSUserBundle'),
					'first_options' => array('label' => 'form.password'),
					'second_options' => array('label' => 'form.password_confirmation'),
					'invalid_message' => 'fos_user.password.mismatch',
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
			return 'app_user_registration';
		}

	}

?>
