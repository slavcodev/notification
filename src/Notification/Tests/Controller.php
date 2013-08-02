<?php
/**
 * Slavcodev Components
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

namespace Notification\Tests;

// Domain
use Notification\Model\Messenger;
use Notification\Model\Queue;
use Notification\Model\Message;
use Notification\Service\MessageServiceInterface;
use Notification\Service\MessengerServiceInterface;
use Notification\Service\QueueServiceInterface;

// Infra
use Notification\Infra\InMemory\MessengerService;
use Notification\Infra\InMemory\QueueService;

/**
 * Class Controller
 *
 * @author Veaceslav Medvedev <slavcopost@gmail.com>
 * @version 0.1
 */
class Controller extends \PhpUnit_Framework_TestCase
{
	/** @var MessengerServiceInterface */
	private $messengerService;
	/** @var QueueServiceInterface */
	private $queueService;
	/** @var MessageServiceInterface */
	private $messageService;

	public function setUp()
	{
		$this->messengerService = new MessengerService();
		$this->queueService = new QueueService();
		$this->messageService = new Logger();
	}

	public function testDomain()
	{
		// Создаем рассылку
		$messenger = new Messenger('slavcodev');

		// Подписываем очередь на рассылку
		$queue1 = new Queue('user1');
		$messenger->bind($queue1);

		// Подписываем очередь на рассылку
		$queue2 = new Queue('user2');
		$messenger->bind($queue2, new SpecificationById('ID1'));
		$messenger->bind($queue2, new SpecificationById('ID2'));
		$messenger->bind($queue2, new SpecificationById('ID3'));

		$messenger->unbind($queue2, new SpecificationById('ID3'));

		// Отправляем сообщения
		$messenger->send(new Message('ID1'));
		$messenger->send(new Message('ID1'));
		$messenger->send(new Message('ID2'));
		$messenger->send(new Message('ID3'));
		$messenger->send(new Message('ID3'));

		$this->assertEquals(5, $queue1->count());
		$this->assertEquals(3, $queue1->seek(2)->count());
		$this->assertEquals(3, $queue2->count());
		$this->assertEquals(1, $queue2->seek(2)->count());
	}

	public function testInfrastructure()
	{
		// Создаем рассылку
		$messenger = new Messenger('messenger');
		$queue = new Queue('queue');

		// Подписываем очередь на рассылку
		$messenger->bind($queue);

		// Сохраняемся
		$this->messengerService->save($messenger);
		$this->queueService->save($queue);

		// Восстанавливаем сохранения
		$messenger = $this->messengerService->get('messenger');
		$queue = $this->queueService->get('queue');

		$this->assertNull($this->messengerService->get('queue'));
		$this->assertNull($this->queueService->get('messenger'));
		$this->assertInstanceOf('Notification\Model\Messenger', $messenger);
		$this->assertInstanceOf('Notification\Model\Queue', $queue);

		// Рассылаем сообщения
		$messenger->send(new Message('ID1'));
		$messenger->send(new Message('ID2'));

		$this->assertEquals(2, $queue->count());
		$this->assertEquals(1, $queue->seek(1)->count());

		$this->messageService
			->publish($queue->dequeue())
			->dispatch($queue);
	}
}
