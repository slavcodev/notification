<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

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
	 * @param mixed $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function getMeta($key = null, $default = null);

	/**
	 * @return DateTime
	 */
	public function getCreateAt();
}
