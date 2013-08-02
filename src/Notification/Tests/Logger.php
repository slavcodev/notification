<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Tests;

use Notification\Model\MessageInterface;
use Notification\Model\MessengerInterface;
use Notification\Model\QueueInterface;
use Notification\Service\MessageServiceInterface;

/**
 * Class Logger
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Logger implements MessageServiceInterface
{
	/**
	 * @param MessageInterface $message
	 * @return MessageServiceInterface
	 */
	public function publish(MessageInterface $message)
	{
		echo sprintf('Publish "%s" message', serialize($message)), PHP_EOL;
		return $this;
	}

	/**
	 * @param QueueInterface $queue
	 * @return MessageServiceInterface
	 */
	public function dispatch(QueueInterface $queue)
	{
		while ($message = $queue->dequeue()) {
			$this->publish($message);
		}

		return $this;
	}

	/**
	 * @param MessageInterface $message
	 * @param MessengerInterface $messenger
	 * @return MessageServiceInterface
	 */
	public function send(
		MessageInterface $message,
		MessengerInterface $messenger
	) {
		foreach ($messenger->getIterator() as $queue) {
			$queue->enqueue($message);
		}

		return $this;
	}
}
