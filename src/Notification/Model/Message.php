<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use DateTime;
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
	/** @var DateTime */
	protected $createAt;
	/** @var array */
	protected $meta = array();

	/**
	 * @param $id
	 * @param array $meta
	 */
	public function __construct($id, $meta = array())
	{
		$this->id = $id;
		$this->createAt = new DateTime();
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
	 * @return DateTime
	 */
	public function getCreateAt()
	{
		return $this->createAt;
	}

	/**
	 * @return string
	 */
	public function serialize()
	{
		return serialize(array(
				$this->getId(),
				$this->getCreateAt()->format(DateTime::W3C),
				$this->getMeta(),
			));
	}

	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized)
	{
		$data = (array) unserialize($serialized);

		$this->id = array_shift($data);
		$this->createAt = DateTime::createFromFormat(DateTime::W3C, array_shift($data));
		$this->setMeta(array_shift($data));
	}

	public function publish(MessageServiceInterface $service)
	{
		$service->publish($this);
	}
}
