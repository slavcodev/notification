<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Notification\Service\MessageServiceInterface;

/**
 * Class Message
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Message implements MessageInterface
{
	/** @var mixed */
	protected $id;
	/** @var array */
	protected $meta = array();

	/**
	 * @param $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return array
	 */
	public function getMeta()
	{
		return $this->meta;
	}

	/**
	 * @param array $meta
	 * @return MessageInterface
	 */
	public function setMeta($meta)
	{
		$this->meta = (array) $meta;

		return $this;
	}

	/**
	 * @return string
	 */
	public function serialize()
	{
		return serialize(array_merge(
			array('id' => $this->getId()),
			$this->getMeta()
		));
	}

	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized)
	{
		$this->meta = (array) unserialize($serialized);

		if (isset($this->meta['id'])) {
			$this->id = $this->meta['id'];
			unset($this->meta['id']);
		}
	}

	public function publish(MessageServiceInterface $service)
	{
		$service->publish($this);
	}
}
