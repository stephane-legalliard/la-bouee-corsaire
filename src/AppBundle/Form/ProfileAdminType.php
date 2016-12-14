<?php

	namespace AppBundle\Form;

	use FOS\UserBundle\Util\LegacyFormHelper;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class ProfileAdminType extends AbstractType {
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
			$builder
				->add('username', null, array(
					'translation_domain' => 'FOSUserBundle',
					'label' => 'form.username',
				))
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
				))
				->add('description', null, array(
					'translation_domain' => false,
					'label' => 'Description',
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
