<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

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
	/** @var array|QueueInterface[] */
	protected $queues = array();
	/** @var array */
	protected $specifications = array();

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
	 * @param QueueInterface $queue
	 * @param $specification
	 */
	public function bind(QueueInterface $queue, SpecificationInterface $specification = null)
	{
		$this->queues[$queue->getId()] = $queue;

		if (null !== $specification) {
			if (!isset($this->specifications[$queue->getId()])) {
				$this->specifications[$queue->getId()] = array();
			}

			$this->specifications[$queue->getId()][(string) $specification] = $specification;
		}
	}

	/**
	 * @param QueueInterface $queue
	 * @param $specification
	 */
	public function unbind(QueueInterface $queue, SpecificationInterface $specification = null)
	{
		if (null === $specification) {
			if (isset($this->queues[$queue->getId()])) {
				unset($this->queues[$queue->getId()]);
			}

			if (isset($this->specifications[$queue->getId()])) {
				unset($this->specifications[$queue->getId()]);
			}
		} elseif (isset($this->specifications[$queue->getId()][(string) $specification])) {
			unset($this->specifications[$queue->getId()][(string) $specification]);
		}
	}

	/**
	 * @param MessageInterface $message
	 */
	public function send(MessageInterface $message)
	{
		foreach ($this->queues as $queue) {
			$valid = true;

			if (isset($this->specifications[$queue->getId()])) {
				foreach ($this->specifications[$queue->getId()] as $specification) {
					/** @var SpecificationInterface $specification */
					if ($specification->isValid($message)) {
						$valid = true;
						break;
					} else {
						$valid = false;
					}
				}
			}

			if ($valid) {
				$queue->enqueue($message);
			}
		}
	}
}
