<?php
	
	namespace AppBundle\Entity;
	
	use Doctrine\ORM\Mapping as ORM;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="users")
	 */
	class User {
		/**
		 * User ID
		 *
		 * @ORM\Column(type="integer")
		 * @ORM\Id
		 * @ORM\GeneratedValue(strategy="AUTO")
		 *
		 * @var    INT $id
		 * @access private
		 */
		private $id;
		
		/**
		 * User nickname, used to identify it on the application
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $nick
		 * @access private
		 */
		private $nick;
		
		/**
		 * User name, only shown during transactions
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $name
		 * @access private
		 */
		private $name;
		
		/**
		 * User surname, only shown during transactions
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $surname
		 * @access private
		 */
		private $surname;
		
		/**
		 * User physical adress, visible only by the administrator
		 *
		 * @ORM\Column(type="text")
		 *
		 * @var    TEXT $adress
		 * @access private
		 */
		private $adress;
		
		/**
		 * User e-mail adress
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $email
		 * @access private
		 */
		private $email;
		
		/**
		 * User password (encrypted)
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $password
		 * @access private
		 */
		private $password;
		
		/**
		 * User short text description
		 *
		 * @ORM\Column(type="text")
		 *
		 * @var    TEXT $description
		 * @access private
		 */
		private $description;
		
		/**
		 * User region
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $region
		 * @access private
		 */
		private $region;
		
		/**
		 * User city
		 *
		 * @ORM\Column(type="string", length=100)
		 *
		 * @var    VARCHAR $city
		 * @access private
		 */
		private $city;
		
		/**
		 * User phone number (optional)
		 *
		 * @ORM\Column(type="bigint")
		 *
		 * @var    BIGINT $phone
		 * @access private
		 */
		private $phone;
		
		/**
		 * User hours credit
		 *
		 * @ORM\Column(type="float")
		 *
		 * @var    FLOAT $hours
		 * @access private
		 */
		private $hours;
		
		/**
		 * User status, may be "new", "active" or "disabled"
		 *
		 * @var    ENUM $status
		 * @access private
		 */
		private $status;
		
		/**
		 * User role, may be "USER" or "ADMIN"
		 *
		 * @var    ENUM $role
		 * @access private
		 */
		private $role;
		
		/**
		 * Get id
		 *
		 * @return integer
		 */
		public function getId()
		{
			return $this->id;
		}
		
		/**
		 * Set nick
		 *
		 * @param string $nick
		 *
		 * @return User
		 */
		public function setNick($nick)
		{
			$this->nick = $nick;
			
			return $this;
		}
		
		/**
		 * Get nick
		 *
		 * @return string
		 */
		public function getNick()
		{
			return $this->nick;
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
			$this->name = $name;
			
			return $this;
		}
		
		/**
		 * Get name
		 *
		 * @return string
		 */
		public function getName()
		{
			return $this->name;
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
			$this->surname = $surname;
			
			return $this;
		}
		
		/**
		 * Get surname
		 *
		 * @return string
		 */
		public function getSurname()
		{
			return $this->surname;
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
			$this->adress = $adress;
			
			return $this;
		}
		
		/**
		 * Get adress
		 *
		 * @return string
		 */
		public function getAdress()
		{
			return $this->adress;
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
			$this->email = $email;
			
			return $this;
		}
		
		/**
		 * Get email
		 *
		 * @return string
		 */
		public function getEmail()
		{
			return $this->email;
		}
		
		/**
		 * Set password
		 *
		 * @param string $password
		 *
		 * @return User
		 */
		public function setPassword($password)
		{
			$this->password = $password;
			
			return $this;
		}
		
		/**
		 * Get password
		 *
		 * @return string
		 */
		public function getPassword()
		{
			return $this->password;
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
			$this->description = $description;
			
			return $this;
		}
		
		/**
		 * Get description
		 *
		 * @return string
		 */
		public function getDescription()
		{
			return $this->description;
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
			$this->region = $region;
			
			return $this;
		}
		
		/**
		 * Get region
		 *
		 * @return string
		 */
		public function getRegion()
		{
			return $this->region;
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
			$this->city = $city;
			
			return $this;
		}
		
		/**
		 * Get city
		 *
		 * @return string
		 */
		public function getCity()
		{
			return $this->city;
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
			$this->phone = $phone;
			
			return $this;
		}
		
		/**
		 * Get phone
		 *
		 * @return integer
		 */
		public function getPhone()
		{
			return $this->phone;
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
			$this->hours = $hours;
			
			return $this;
		}
		
		/**
		 * Get hours
		 *
		 * @return float
		 */
		public function getHours()
		{
			return $this->hours;
		}
	
}
