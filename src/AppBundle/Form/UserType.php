<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use FOS\UserBundle\Util\LegacyFormHelper;

	abstract class UserType extends AbstractType {

		/**
		 * @var string
		 */
		protected $class;

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
