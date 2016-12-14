<?php

	namespace AppBundle\Entity;

	use AppBundle\Entity\User;
	use Doctrine\ORM\Mapping as ORM;

	/**
	 * @ORM\Entity
	 * @ORM\Table(name="messages")
	 */
	class Message {

		/**
		 * Message ID
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
		 * Message content
		 *
		 * @ORM\Column(type="text", length=65535)
		 *
		 * @var    string
		 * @access protected
		 */
		protected $content;

		/**
		 * Date of Message creation
		 *
		 * @ORM\Column(type="datetimetz")
		 *
		 * @var    DateTime
		 * @access protected
		 */
		protected $date;
		
		/**
		 * User who sent the Message
		 *
		 * @ORM\ManyToOne(targetEntity="User")
		 *
		 * @var    User
		 * @access private
		 */
		protected $author;

		/**
		 * User who received the Message
		 *
		 * @ORM\ManyToOne(targetEntity="User")
		 *
		 * @var    User
		 * @access private
		 */
		protected $dest;

		/**
		 * Get id
		 *
		 * @return integer
		 */
		public function getId() { return $this->id; }

		/**
		 * Get content
		 *
		 * @return string
		 */
		public function getContent() { return $this->content; }

		/**
		 * Get date
		 *
		 * @return \DateTime
		 */
		public function getDate() { return $this->date; }

		/**
		 * Get author
		 *
		 * @return \AppBundle\Entity\User
		 */
		public function getAuthor() { return $this->author; }

		/**
		 * Get dest
		 *
		 * @return \AppBundle\Entity\User
		 */
		public function getDest() { return $this->dest; }

		/**
		* Set content
		*
		* @param string $content
		*
		* @return Message
		*/
		public function setContent($content) {
			$this->content = $content;
			return $this;
		}

		/**
		* Set date
		*
		* @param \DateTime $date
		*
		* @return Message
		*/
		public function setDate(\DateTime $date) {
			$this->date = $date;
			return $this;
		}

		/**
		* Set author
		*
		* @param \AppBundle\Entity\User $author
		*
		* @return Message
		*/
		public function setAuthor(\AppBundle\Entity\User $author = null) {
			$this->author = $author;
			return $this;
		}

		/**
		* Set dest
		*
		* @param \AppBundle\Entity\User $dest
		*
		* @return Message
		*/
		public function setDest(\AppBundle\Entity\User $dest = null) {
			$this->dest = $dest;
			return $this;
		}

	}

?>
