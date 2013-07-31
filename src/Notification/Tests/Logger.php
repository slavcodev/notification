<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Tests;

use Notification\Model\MessageInterface;
use Notification\Service\MessageServiceInterface;

/**
 * Class Logger
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Logger implements MessageServiceInterface
{
	public function publish(MessageInterface $message)
	{
		echo sprintf('Publish "%s" message', serialize($message)), PHP_EOL;
	}
}
