<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

use IteratorAggregate;

/**
 * Interface MessengerInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessengerInterface extends IteratorAggregate
{
	/**
	 * @return mixed
	 */
	public function getId();

	/**
	 * @return \Traversable|QueueInterface[]
	 */
	public function getIterator();

	/**
	 * @param QueueInterface $queue
	 * @param SpecificationInterface $specification
	 * @return void
	 */
	public function bind(QueueInterface $queue, SpecificationInterface $specification = null);

	/**
	 * @param QueueInterface $queue
	 * @param SpecificationInterface $specification
	 * @return void
	 */
	public function unbind(QueueInterface $queue, SpecificationInterface $specification = null);
}
