<?php

	namespace AppBundle\Entity;

	/**
	 * Common properties and methods for entities that can be enabled/disabled
	 */
	trait StatusTrait {
		/**
		 * Status (enabled/disabled)
		 *
		 * @ORM\Column(type="boolean")
		 *
		 * @var    boolean
		 * @access protected
		 */
		protected $enabled = true;

		/**
		 * Return status (enabled/disabled)
		 *
		 * @return string
		 */
		public function getEnabled() { return $this->enabled; }

		/**
		 * Set status (enabled/disabled)
		 *
		 * @param string
		 *
		 * @return Task
		 */
		public function setEnabled($enabled) {
			$this->enabled = $enabled;
			return $this;
		}

		/**
		 * Return whether the entity is disabled
		 *
		 * @return boolean
		 */
		public function isDisabled() {
			return (!$this->getEnabled());
		}

		/**
		 * Disable the entity
		 *
		 * @return Task
		 */
		public function disable() {
			$this->setEnabled(false);
			return $this;
		}

		/**
		 * Enable the entity
		 *
		 * @return Task
		 */
		public function enable() {
			$this->setEnabled(true);
			return $this;
		}

	}

?>
