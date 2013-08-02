<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Notification\Service\MessageServiceInterface;
use DateTime;
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
	 * @param array $meta
	 * @return MessageInterface
	 */
	public function setMeta($meta);

	/**
	 * @return array
	 */
	public function getMeta();

	/**
	 * @return DateTime
	 */
	public function getCreateAt();

	/**
	 * @param MessageServiceInterface $service
	 * @return void
	 */
	public function publish(MessageServiceInterface $service);
}
