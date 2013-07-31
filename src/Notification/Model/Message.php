<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Notification\Service\MessageServiceInterface;
use StdLib\VarDumper;

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
	 * @param array $meta
	 */
	public function __construct($id, $meta = array())
	{
		$this->id = $id;
		$this->setMeta($meta);
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
		return serialize(array(
				$this->getId(),
				$this->getMeta(),
			));
	}

	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized)
	{
		list($this->id, $this->meta) = (array) unserialize($serialized);
	}

	public function publish(MessageServiceInterface $service)
	{
		$service->publish($this);
	}
}
