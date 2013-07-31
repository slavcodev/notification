<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Notification\Service\MessageServiceInterface;
use Serializable;

/**
 * Interfaces MessageInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessageInterface extends Serializable
{
	/**
	 * @return mixed
	 */
	public function getId();

	/**
	 * @param MessageServiceInterface $service
	 * @return void
	 */
	public function publish(MessageServiceInterface $service);
}
