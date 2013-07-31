<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Tests;

use Notification\Model\MessageInterface;
use Notification\Model\SpecificationInterface;

/**
 * Class SpecificationById
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class SpecificationById implements SpecificationInterface
{
	protected $id;

	function __construct($id)
	{
		$this->id = $id;
	}

	public function serialize()
	{
		return '';
	}

	public function unserialize($serialized)
	{}

	public function __toString()
	{
		return (string) $this->id;
	}

	public function isValid(MessageInterface $message)
	{
		return $message->getId() === $this->id;
	}
}
