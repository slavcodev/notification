<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Service;

use Notification\Model\MessengerInterface;

/**
 * Interface MessengerServiceInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessengerServiceInterface
{
	/**
	 * @param $id
	 * @return MessengerInterface
	 */
	public function get($id);

	/**
	 * @param MessengerInterface $messenger
	 * @return void
	 */
	public function save(MessengerInterface $messenger);

	/**
	 * @param MessengerInterface $messenger
	 * @return void
	 */
	public function delete(MessengerInterface $messenger);
}
