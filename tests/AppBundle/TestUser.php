<?php
	
	namespace Tests\AppBundle;
	
	use AppBundle\Entity\User;
	
	class TestUser extends User {
		/**
		 * @param $id
		 */
		public function setId($id) {
			$this->id = $id;
		}
	}
	
?>
