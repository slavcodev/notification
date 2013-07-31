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
	 * @return string
	 */
	public function serialize()
	{
		return serialize(array(
				$this->id,
				'Message body',
			));
	}

	/**
	 * @param string $serialized
	 */
	public function unserialize($serialized)
	{
		list(
			$this->id
			) = unserialize($serialized);
	}

	public function publish(MessageServiceInterface $service)
	{
		$service->publish($this);
	}
}
