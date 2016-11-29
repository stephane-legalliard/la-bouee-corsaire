<?php
	
	namespace AppBundle\Entity;
	
	use AppBundle\Entity\Task;
	use Doctrine\ORM\Mapping as ORM;
	//use Symfony\Component\Validator\Constraints as Assert;
	
	/**
	 * @ORM\Entity
	 * @ORM\Table(name="needs")
	 */
	class Need extends Task {
		//TODO
	}
	
?>
