<?php
	
	namespace Tests\AppBundle\Entity;
	
	use AppBundle\Entity\User;
	
	class UserTest extends User {
		/**
		 * @param $id
		 */
		public function setId($id) {
			$this->id = $id;
		}
	}
	
?>
