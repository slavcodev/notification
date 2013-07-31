<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Infra\AMQP;

use Notification\Model\MessageInterface;
use Notification\Model\QueueInterface;
use Exception;

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
	protected $queue;

	/**
	 * @param $id
	 * @param AMQPConnection $cnn
	 */
	public function __construct($id, AMQPConnection $cnn)
	{
		$this->id = $id;
		$this->queue = new AMQPQueue($cnn, $this->getId());
		$this->queue->declare_($this->getId(), AMQP_AUTODELETE | AMQP_DURABLE);
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
		$this->queue->consume((int) $position);

		return $this;
	}

	public function count()
	{
		return $this->queue->declare_($this->getId());
	}

	/**
	 * @param MessageInterface $message
	 * @return $this
	 */
	public function enqueue(MessageInterface $message)
	{
		throw new Exception('Not implement');
	}

	/**
	 * @return MessageInterface
	 */
	public function dequeue()
	{
		$res = $this->queue->get();

		if ($res['count'] == -1) {
			return null;
		}

		return unserialize($res['msg']);
	}
}
