<?php

	namespace AppBundle\Form;

	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use FOS\UserBundle\Util\LegacyFormHelper;

	/**
	 * Base used by all forms related to Users creation/edition
	 */
	abstract class UserType extends AbstractType {

		/**
		 * Associated class
		 *
		 * @var string
		 */
		protected $class;

		/**
		 * Contruct, set the associated class
		 *
		 * @param string $class The User class name
		 */
		public function __construct($class = 'AppBundle\Entity\User') {
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
				->add('name', null, [
					'translation_domain' => false,
					'label' => 'Prénom',
				])
				->add('surname', null, [
					'translation_domain' => false,
					'label' => 'Nom',
				])
				->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'),[
					'translation_domain' => 'FOSUserBundle',
					'label' => 'form.email',
				])
				->add('adress', null, [
					'translation_domain' => false,
					'label' => 'Adresse',
				])
				->add('region', null, [
					'translation_domain' => false,
					'label' => 'Région',
				])
				->add('city', null, [
					'translation_domain' => false,
					'label' => 'Ville',
				])
				->add('phone', null, [
					'translation_domain' => false,
					'label' => 'Téléphone (optionnel)',
				]);
			}

	}

?>
