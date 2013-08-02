<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Service;

use Notification\Model\MessageInterface;
use Notification\Model\MessengerInterface;
use Notification\Model\QueueInterface;

/**
 * Interface MessageServiceInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessageServiceInterface
{
	/**
	 * @param MessageInterface $message
	 * @return MessageServiceInterface
	 */
	public function publish(MessageInterface $message);

	/**
	 * @param QueueInterface $queue
	 * @return MessageServiceInterface
	 */
	public function dispatch(QueueInterface $queue);

	/**
	 * @param MessageInterface $message
	 * @param MessengerInterface $messenger
	 * @return MessageServiceInterface
	 */
	public function send(MessageInterface $message, MessengerInterface $messenger);
}
