<?php
	
	namespace AppBundle\Entity;
	
	use FOS\UserBundle\Model\User as BaseUser;
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="users")
	 */
	class User extends BaseUser {
		/**
		 * User ID
		 *
		 * @ORM\Column(type="integer")
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
		 * @var    string
		 * @access protected
		 */
		protected $name;
		
		/**
		 * User surname, only shown during transactions
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    string
		 * @access protected
		 */
		protected $surname;
		
		/**
		 * User physical adress, visible only by the administrator
		 *
		 * @ORM\Column(type="text")
		 *
		 * @var    string
		 * @access protected
		 */
		protected $adress;
		
		/**
		 * User short text description
		 *
		 * @ORM\Column(type="text")
		 *
		 * @var    string
		 * @access protected
		 */
		protected $description;
		
		/**
		 * User region
		 *
		 * @ORM\Column(type="string", length=100)
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
		 * @var    string
		 * @access protected
		 */
		protected $city;
		
		/**
		 * User phone number (optional)
		 *
		 * @ORM\Column(type="bigint")
		 *
		 * @var    int
		 * @access protected
		 */
		protected $phone;
		
		/**
		 * User hours credit
		 *
		 * @ORM\Column(type="float")
		 *
		 * @var    float
		 * @access protected
		 */
		protected $hours;
		
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
		 * Get description
		 *
		 * @return string
		 */
		public function getDescription() { return $this->description; }
		
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
		 * Get hours
		 *
		 * @return float
		 */
		public function getHours() { return $this->hours; }
		
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
			
			$this->adress = $adress;
			
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
		 * Set description
		 *
		 * @param string $description
		 *
		 * @return User
		 */
		public function setDescription($description)
		{
			$description = (string) $description;
			
			$this->description = $description;
			
			return $this;
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
			$phone = (int) $phone;
			
			if (strlen($phone) == 10) {
				$this->phone = $phone;
			}
			
			return $this;
		}
		
		/**
		 * Set hours
		 *
		 * @param float $hours
		 *
		 * @return User
		 */
		public function setHours($hours)
		{
			$hours = (float) $hours;
			
			$this->hours = $hours;
			
			return $this;
		}
	
}
