<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Countable;
// use SeekableIterator;

/**
 * Class Queue
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface QueueInterface extends Countable//, SeekableIterator
{
	/**
	 * @return mixed
	 */
	public function getId();

	/**
	 * @param $position
	 * @return mixed
	 */
	public function seek($position);

	/**
	 * @param MessageInterface $message
	 */
	public function enqueue(MessageInterface $message);

	/**
	 * @return MessageInterface
	 */
	public function dequeue();
}
