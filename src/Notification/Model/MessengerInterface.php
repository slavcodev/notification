<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Model;

/**
 * Interface MessengerInterface
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
interface MessengerInterface
{
	/**
	 * @return mixed
	 */
	public function getId();

	/**
	 * @param MessageInterface $message
	 * @return void
	 */
	public function send(MessageInterface $message);

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
