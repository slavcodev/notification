<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Infra\InMemory;

use Notification\Model\MessengerInterface;
use Notification\Service\MessengerServiceInterface;

/**
 * Class MessengerService
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class MessengerService implements MessengerServiceInterface
{
	private static $registry = array();

	/**
	 * @param $id
	 * @return MessengerInterface
	 */
	public function get($id)
	{
		if (!isset(self::$registry[$id])) {
			return null;
		}

		$messenger = self::$registry[$id];

		return $messenger;
	}

	public function save(MessengerInterface $messenger)
	{
		self::$registry[$messenger->getId()] = $messenger;
	}

	public function delete(MessengerInterface $messenger)
	{
		if (isset(self::$registry[$messenger->getId()])) {
			unset(self::$registry[$messenger->getId()]);
		}
	}
}
