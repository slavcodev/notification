<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Service;

use Notification\Model\MessageInterface;

/**
 * Interface MessageServiceInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessageServiceInterface
{
	public function publish(MessageInterface $message);
}
