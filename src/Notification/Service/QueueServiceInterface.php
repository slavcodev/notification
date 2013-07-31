<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Service;

use Notification\Model\QueueInterface;

/**
 * Interface QueueServiceInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface QueueServiceInterface
{
	/**
	 * @param $id
	 * @return QueueInterface
	 */
	public function get($id);

	/**
	 * @param QueueInterface $queue
	 * @return void
	 */
	public function save(QueueInterface $queue);

	/**
	 * @param QueueInterface $queue
	 * @return void
	 */
	public function delete(QueueInterface $queue);
}
