<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

/**
 * Class Queue
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Queue implements QueueInterface
{
	/** @var mixed */
	protected $id;
	/** @var array */
	protected $messages = array();

	/**
	 * @param mixed $id
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
	 * @param int $position
	 * @return $this
	 */
	public function seek($position)
	{
		while((int) $position-- > 0) {
			$this->dequeue();
		}

		return $this;
	}

	public function count()
	{
		return count($this->messages);
	}

	/**
	 * @param MessageInterface $message
	 * @return $this
	 */
	public function enqueue(MessageInterface $message)
	{
		array_push($this->messages, $message);

		return $this;
	}

	/**
	 * @return MessageInterface
	 */
	public function dequeue()
	{
		return array_pop($this->messages);
	}
}
