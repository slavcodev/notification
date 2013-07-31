<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Infra\AMQP;

use Notification\Model\MessageInterface;
use Notification\Model\MessengerInterface;
use Notification\Model\QueueInterface;
use Notification\Model\SpecificationInterface;

/**
 * Class Messenger
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Messenger implements MessengerInterface
{
	/** @var mixed */
	protected $id;
	protected $exchange;

	/**
	 * @param $id
	 * @param AMQPConnection $cnn
	 */
	public function __construct($id, AMQPConnection $cnn)
	{
		$this->id = $id;
		$this->exchange = new AMQPExchange($cnn);
		$this->exchange->declare_($this->getId(), 'topic', AMQP_DURABLE);
	}

	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param QueueInterface $queue
	 * @param SpecificationInterface $specification
	 */
	public function bind(QueueInterface $queue, SpecificationInterface $specification = null)
	{
		$specification = $specification ?: '*';
		$this->exchange->bind($queue->getId(), (string) $specification);
	}

	/**
	 * @param QueueInterface $queue
	 * @param SpecificationInterface $specification
	 */
	public function unbind(QueueInterface $queue, SpecificationInterface $specification = null)
	{
		$specification = $specification ?: '*';
		$this->exchange->unbind($queue->getId(), (string) $specification);
	}

	/**
	 * @param MessageInterface $message
	 */
	public function send(MessageInterface $message)
	{
		$this->exchange->publish(serialize($message), $message->getId());
	}
}


define('AMQP_DURABLE', 1);
define('AMQP_AUTODELETE', 2);

class AMQPConnection {}
class AMQPExchange {
	public $name = 'exchangeName';
	public function declare_(){}
	public function publish($msg, $key){}
	public function bind($queueName, $key){}
	public function unbind($queueName, $key){}
}
class AMQPQueue {
	public function bind($exchangeName, $key){}
	public function unbind($exchangeName, $key){}
	public function purge(){}
	public function consume($n){return array();}
	public function declare_(){return 0;}
	public function get(){return array('count' => 'remainCount', 'msg' => 'msg');}
}
class AMQPMessage {
	function __construct($body, array $params) {
	}
}
