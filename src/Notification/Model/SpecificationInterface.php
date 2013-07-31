<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use Serializable;

/***
 * Interfaces SpecificationInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface SpecificationInterface extends Serializable
{
	public function __toString();

	public function isValid(MessageInterface $message);
}
