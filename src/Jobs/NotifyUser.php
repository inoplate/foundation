<?php

namespace Inoplate\Foundation\Jobs;

use Inoplate\Notifier\Laravel\NotifierFactory;

class NotifyUser
{
    /**
     * Message owner
     * 
     * @var mixed
     */
    protected $userId;

    /**
     * Message
     * 
     * @var string
     */
    protected $message;

    /**
     * Notifier drivers
     * 
     * @var array|string
     */
    protected $drivers;

    /**
     * Create new NotifyUser instance
     * 
     * @param mixed $userId
     * @param string $message
     * @param array|string $drivers
     * @param string $url
     */
    public function __construct($userId, $message, $drivers, $url = '')
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->drivers = $drivers;
        $this->url = $url;
    }

    /**
     * Handle job
     * 
     * @param  NotifierFactory $notifierFactory
     * 
     * @return void
     */
    public function handle(NotifierFactory $notifierFactory)
    {
        $userId = $this->userId;
        $message = $this->message;
        $drivers = $this->drivers;
        $url = $this->url;

        if(is_array($drivers)) {
            foreach ($drivers as $driver) {
                $this->notify($notifierFactory, $driver, $userId, $message, $url);    
            }
        }else {
            $this->notify($notifierFactory, $drivers, $userId, $message, $url);
        }
    }

    /**
     * Send notification to user
     * 
     * @param  NotifierFactory $notifierFactory
     * @param  string          $driver
     * @param  string          $userId
     * @param  mixed           $message
     * 
     * @return void
     */
    protected function notify(NotifierFactory $notifierFactory, $driver, $userId, $message, $url)
    {
        $notifierFactory->drive($driver)->notify($message, $userId, $url);
    }
}