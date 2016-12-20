<?php
	
	namespace AppBundle\Form;
	
	use FOS\UserBundle\Util\LegacyFormHelper;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class RegistrationType extends AbstractType {
		
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
			 ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
			 	'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
			 	'options' => array('translation_domain' => 'FOSUserBundle'),
			 	'first_options' => array('label' => 'form.password'),
			 	'second_options' => array('label' => 'form.password_confirmation'),
			 	'invalid_message' => 'fos_user.password.mismatch',
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
