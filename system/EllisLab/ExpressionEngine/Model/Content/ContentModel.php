<?php

namespace EllisLab\ExpressionEngine\Model\Content;

use EllisLab\ExpressionEngine\Service\Model\Model;

/**
 * create: new ChannelEntry()->getForm();
 * existing: $entry->fill($data)->getForm();
 * set data: $entry->title = "Foo"; $entry->getForm();
 * mass set: $entry->set(array); $entry->getForm();
 */

abstract class ContentModel extends Model {

	protected $_field_facades;

	abstract public function getStructure();

	abstract public function getCustomFieldPrefix();

	/**
	 * Optional
	 */
	protected function getDefaultFields()
	{
		return array();
	}

	/**
	 *
	 */
	protected function populateDefaultFields()
	{
		return;
	}

	/**
	 *
	 */
	public function getForm($field_name = NULL)
	{
		$this->usesCustomFields();

		if (isset($field_name))
		{
			if ($this->hasCustomField($field_name))
			{
				return new FieldDisplay($this->getCustomField($field_name));
			}

			throw new InvalidArgumentException("No such field: '{$field_name}' on ".get_called_class());
		}

		return array_map(
			function($field) { return new FieldDisplay($field); },
			$this->_field_facades
		);
	}

	/**
	 * Ensures that custom fields are setup and their data is in sync.
	 */
	protected function usesCustomFields()
	{
		if ( ! isset($this->_field_facades))
		{
			$this->initializeCustomFields();
			$this->populateDefaultFields();
		}
	}

	/**
	 *
	 */
	protected function fillCustomFields($data)
	{
		$this->usesCustomFields();

		foreach ($data as $name => $value)
		{
			if ($this->hasCustomField($name))
			{
				$this->getCustomField($name)->setData($value);
			}
		}
	}

	/**
	 * Magic meat
	 */
	protected function initializeCustomFields()
	{
		$this->_field_facades = array();

		$default_fields = $this->getDefaultFields();

		foreach ($default_fields as $id => $field)
		{
			$this->addFacade($id, $field);
		}

		$native_fields = $this->getStructure()->getCustomFields();
		$native_prefix = $this->getCustomFieldPrefix();

		foreach ($native_fields as $field)
		{
			$this->addFacade(
				$field->getId(),
				$field->toArray(),
				$native_prefix
			);
		}
	}

	/**
	 *
	 */
	protected function addFacade($id, $info, $name_prefix = '')
	{
		$name = $name_prefix.$id;

		$facade = new FieldFacade($id, $info);
		$facade->setName($name);

		$this->_field_facades[$name] = $facade;
	}


	/**
	 * Field accessors
	 */
	public function hasCustomField($name)
	{
		if ( ! isset($this->_field_facades))
		{
			return FALSE;
		}

		return array_key_exists($name, $this->_field_facades);
	}

	/**
	 *
	 */
	public function getCustomField($name)
	{
		return $this->_field_facades[$name];
	}


	/**
	 *
	 */
	public function fill($data)
	{
		parent::fill($data);

		$this->fillCustomFields($data);

		return $this;
	}

	/**
	 * Entity tweaks to support setting and getting correctly
	 */
	public function hasProperty($name)
	{
		if ( ! parent::hasProperty($name))
		{
			return $this->hasCustomField($name);
		}

		return TRUE;
	}

	/**
	 *
	 */
	public function getProperty($name)
	{
		if ( ! parent::hasProperty($name) && $this->hasCustomField($name))
		{
			return $this->getCustomField($name)->getData();
		}

		return parent::getProperty($name);
	}

	/**
	 *
	 */
	public function setProperty($name, $value)
	{
		if ($this->hasCustomField($name))
		{
			$this->getCustomField($name)->setData($value);

			if ( ! parent::hasProperty($name))
			{
				return $this;
			}
		}

		return parent::setProperty($name, $value);
	}

}