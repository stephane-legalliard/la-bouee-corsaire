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
			 ->add('username', null, array('label' => 'Pseudonyme'))
			 ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
			 	'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
			 	'options' => array('translation_domain' => 'FOSUserBundle'),
			 	'first_options' => array('label' => 'Mot de passe'),
			 	'second_options' => array('label' => 'Mot de passe (confirmation)'),
			 	'invalid_message' => 'fos_user.password.mismatch',
			 ))
			 ->add('name', null, array('label' => 'Prénom'))
			 ->add('surname', null, array('label' => 'Nom'))
			 ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'Adresse e-mail'))
			 ->add('adress', null, array('label' => 'Adresse'))
			 ->add('region', null, array('label' => 'Région'))
			 ->add('city', null, array('label' => 'Ville'))
			 ->add('phone', null, array('label' => 'Téléphone (optionnel)'))
			 ->add('description', null, array('label' => 'Description'));
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
