<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Infra\InMemory;

use Notification\Model\QueueInterface;
use Notification\Service\QueueServiceInterface;

/**
 * Class QueueService
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class QueueService implements QueueServiceInterface
{
	private static $registry = array();

	/**
	 * @param $id
	 * @return QueueInterface
	 */
	public function get($id)
	{
		if (!isset(self::$registry[$id])) {
			return null;
		}

		$queue = self::$registry[$id];

		return $queue;
	}

	public function save(QueueInterface $queue)
	{
		self::$registry[$queue->getId()] = $queue;
	}

	public function delete(QueueInterface $queue)
	{
		if (isset(self::$registry[$queue->getId()])) {
			unset(self::$registry[$queue->getId()]);
		}
	}
}
