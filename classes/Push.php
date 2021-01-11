<?php

namespace Classes;


class Push
{
	public function __construct()
	{

	}

	public function __call($method, $parameters)
	{
		if (method_exists($this, $method)) {
			return $this->$method(...$parameters);
		}
		throw  new Exception("Method does not exists", 500);

	}

	public function trigger($channelName, $event, $message)
	{
		try{
			self::getPusher()->trigger($channelName, $event, ['message' => $message]);
		} catch (\Exception $e) {
			die($e->getMessage());
		}

	}

	private function getPusher()
	{
		$pusherOption = self::getPusherOptions();

		return new \Pusher\Pusher(
			'dc475aee7dec4cb4d5f5',
			'6db87bcd6b9b3a795d50',
			'1135232',
			$pusherOption
		);
	}

	private function getPusherOptions()
	{
		return array (
			'cluster' => 'ap2',
			'useTLS'  => true
		);
	}


}