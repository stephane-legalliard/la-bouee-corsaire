<?php

	namespace AppBundle\Form;

	use FOS\UserBundle\Util\LegacyFormHelper;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

	class ProfileType extends AbstractType {
		/**
		 * @var string
		 */
		private $class;

		/**
		 * @param string $class The User class name
		 */
		public function __construct($class = 'AppBundle\Entity\User') {
			$this->class = $class;
		}

		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options) {
			$this->buildUserForm($builder, $options);

			$constraintsOptions = array(
				'message' => 'fos_user.current_password.invalid',
			);

			if (!empty($options['validation_groups'])) {
				$constraintsOptions['groups'] = array(reset($options['validation_groups']));
			}

			$builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
				'label' => 'form.current_password',
				'translation_domain' => 'FOSUserBundle',
				'mapped' => false,
				'constraints' => new UserPassword($constraintsOptions),
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
			return 'fos_user_profile';
		}

		/**
		 * Builds the embedded form representing the user.
		 *
		 * @param FormBuilderInterface $builder
		 * @param array                $options
		 */
		protected function buildUserForm(FormBuilderInterface $builder, array $options) {
			$builder
				->add('name', null, array(
					'translation_domain' => false,
					'label' => 'Prénom',
				))
				->add('surname', null, array(
					'translation_domain' => false,
					'label' => 'Nom',
				))
				->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),array(
					'translation_domain' => 'FOSUserBundle',
					'label' => 'form.email',
				))
				->add('adress', null, array(
					'translation_domain' => false,
					'label' => 'Adresse',
				))
				->add('region', null, array(
					'translation_domain' => false,
					'label' => 'Région',
				))
				->add('city', null, array(
					'translation_domain' => false,
					'label' => 'Ville',
				))
				->add('phone', null, array(
					'translation_domain' => false,
					'label' => 'Téléphone (optionnel)',
				));
		}
	}

?>
