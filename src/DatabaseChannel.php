<?php

namespace godforhire\DatabaseNotifications;

use Illuminate\Notifications\Notification;
use Illuminate\Container\Container;

class DatabaseChannel
{

    /**
     * Get the application namespace.
     *
     * @return string
     */
    protected function getAppNamespace()
    {
        return Container::getInstance()->getNamespace();
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toDatabase($notifiable);
        $user_id = $message->getUser();
        $data = $message->toJson();
        $now = \Carbon::now();
        \DB::table('notifications')
	      	  ->insert([
	               'id' => $notification->id,
	               'type' => get_class($notification),
	               'notifiable_id' => $user_id,
	               'notifiable_type' => $this->getAppNamespace() . \User::class,
	               'data' => $data,
	               'read_at' => null,
	               'created_at' => $now,
	               'updated_at' => $now
				]);
    }
}