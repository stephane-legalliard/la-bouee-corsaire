<?php
	
	namespace AppBundle\Entity;
	
	use FOS\UserBundle\Model\User as BaseUser;
	use Doctrine\ORM\Mapping as ORM;
	use Symfony\Component\Validator\Constraints as Assert;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="users")
	 */
	class User extends BaseUser {
		/**
		 * User ID
		 *
		 * @ORM\Column(type="integer", options={"unsigned"=true})
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 *
		 * @var    int
		 * @access protected
		 */
		protected $id;
		
		/**
		 * User name, only shown during transactions
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer votre prénom.", groups={"Registration", "Profile"})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="Le prénom est trop court.",
		 * 	maxMessage="Le prénom est trop long.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $name;
		
		/**
		 * User surname, only shown during transactions
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer votre nom.", groups={"Registration", "Profile"})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="Le nom est trop court.",
		 * 	maxMessage="Le nom est trop long.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $surname;
		
		/**
		 * User physical adress, visible only by the administrator
		 *
		 * @ORM\Column(type="text", length=255)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer votre adresse.", groups={"Registration", "Profile"})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=255,
		 * 	minMessage="L’adresse est trop courte.",
		 * 	maxMessage="L’adresse est trop longue.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $adress;
		
		/**
		 * User region
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer votre région.", groups={"Registration", "Profile"})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="La région est trop courte.",
		 * 	maxMessage="La région est trop longue.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $region;
		
		/**
		 * User city
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @Assert\NotBlank(message="Veuillez entrer votre ville.", groups={"Registration", "Profile"})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=100,
		 * 	minMessage="La ville est trop courte.",
		 * 	maxMessage="La ville est trop longue.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $city;
		
		/**
		 * User phone number (optional)
		 *
		 * @ORM\Column(type="string", length=20, nullable=true, options={"default"=null})
		 *
		 * @Assert\Length(
		 * 	min=3,
		 * 	max=20,
		 * 	minMessage="Le numéro de téléphone trop court.",
		 * 	maxMessage="Le numéro de téléphone est trop long.",
		 * 	groups={"Registration", "Profile"}
		 * )
		 *
		 * @var    string
		 * @access protected
		 */
		protected $phone;
		
		/**
		 * User hours credit
		 *
		 * @ORM\Column(type="float", scale=2, nullable=false, options={"unsigned"=true, "default"=0})
		 *
		 * @var    float
		 * @access protected
		 */
		protected $hoursCredit = 0;
		
		/**
		 * User hours debit
		 *
		 * @ORM\Column(type="float", scale=2, nullable=false, options={"unsigned"=true, "default"=0})
		 *
		 * @var    float
		 * @access protected
		 */
		protected $hoursDebit = 0;
		
		/**
		 * Get name
		 *
		 * @return string
		 */
		public function getName() { return $this->name; }
		
		/**
		 * Get surname
		 *
		 * @return string
		 */
		public function getSurname() { return $this->surname; }
		
		/**
		 * Get adress
		 *
		 * @return string
		 */
		public function getAdress() { return $this->adress; }
		
		/**
		 * Get region
		 *
		 * @return string
		 */
		public function getRegion() { return $this->region; }
		
		/**
		 * Get city
		 *
		 * @return string
		 */
		public function getCity() { return $this->city; }
		
		/**
		 * Get phone
		 *
		 * @return integer
		 */
		public function getPhone() { return $this->phone; }
		
		/**
		 * Get hours credit
		 *
		 * @return float
		 */
		public function getHoursCredit() { return $this->hoursCredit; }
		
		/**
		 * Get hours debit
		 *
		 * @return float
		 */
		public function getHoursDebit() { return $this->hoursDebit; }
		
		/**
		 * Get hours total
		 *
		 * @return float
		 */
		public function getHours() { 
			return ($this->hoursCredit - $this->hoursDebit);
		}
		
		/**
		 * Set username
		 *
		 * @param string $username
		 *
		 * @return User
		 */
		public function setUsername($username)
		{
			$username = (string) $username;
			
			$length = strlen($username);
			if ($length >= 3 && $length <= 180) {
				parent::setUsername($username);
			}
		}
		
		/**
		 * Set password (encrypted)
		 *
		 * @param string $password
		 *
		 * @return User
		 */
		public function setPassword($password)
		{
			$username = (string) $password;
			
			$length = strlen($password);
			if ($length >= 3 && $length <= 255) {
				parent::setPassword($password);
			}
		}
		
		/**
		 * Set name
		 *
		 * @param string $name
		 *
		 * @return User
		 */
		public function setName($name)
		{
			$name = (string) $name;
			
			$length = strlen($name);
			if ($length >= 3 && $length <= 100) {
				$this->name = $name;
			}
			
			return $this;
		}
		
		/**
		 * Set surname
		 *
		 * @param string $surname
		 *
		 * @return User
		 */
		public function setSurname($surname)
		{
			$surname = (string) $surname;
			
			$length = strlen($surname);
			if ($length >= 3 && $length <= 100) {
				$this->surname = $surname;
			}
			
			return $this;
		}
		
		/**
		 * Set adress
		 *
		 * @param string $adress
		 *
		 * @return User
		 */
		public function setAdress($adress)
		{
			$adress = (string) $adress;
			
			$length = strlen($adress);
			if ($length >= 3 && $length <= 255) {
				$this->adress = $adress;
			}
			
			return $this;
		}
		
		/**
		 * Set email
		 *
		 * @param string $email
		 *
		 * @return User
		 */
		public function setEmail($email)
		{
			$email = (string) $email;
			
			$length = strlen($email);
			if ($length >= 3 && $length <= 180 && preg_match('/.*@.*/', $email)) {
				parent::setEmail($email);
			}
		}
		
		/**
		 * Set region
		 *
		 * @param string $region
		 *
		 * @return User
		 */
		public function setRegion($region)
		{
			$region = (string) $region;
			
			$length = strlen($region);
			if ($length >= 3 && $length <= 100) {
				$this->region = $region;
			}
			
			return $this;
		}
		
		/**
		 * Set city
		 *
		 * @param string $city
		 *
		 * @return User
		 */
		public function setCity($city)
		{
			$city = (string) $city;
			
			$length = strlen($city);
			if ($length >= 3 && $length <= 100) {
				$this->city = $city;
			}
			
			return $this;
		}
		
		/**
		 * Set phone
		 *
		 * @param integer $phone
		 *
		 * @return User
		 */
		public function setPhone($phone)
		{
			$phone = (string) $phone;
			
			$length = strlen($phone);
			if ($length >= 3 && $length <= 20) {
				$this->phone = $phone;
			}
			
			return $this;
		}
		
		/**
		 * Set hours credit
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function setHoursCredit($hours) {
			$hours = (float) $hours;
			
			if ($hours >= 0) {
				$this->hoursCredit = $hours;
			}
			
			return $this;
		}
		
		/**
		 * Set hours debit
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function setHoursDebit($hours) {
			$hours = (float) $hours;
			
			if ($hours >= 0) {
				$this->hoursDebit = $hours;
			}
			
			return $this;
		}
		
		/**
		 * Add hours
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function addHours($hours) {
			$hours = (float) $hours;
			
			if ($hours >= 0) {
				$this->hoursCredit += $hours;
			}
			
			return $this;
		}
		
		/**
		 * Substract hours
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function subHours($hours) {
			$hours = (float) $hours;
			
			if ($hours >= 0) {
				$this->hoursDebit += $hours;
			}
			
			return $this;
		}
	
}
