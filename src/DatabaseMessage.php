<?php

namespace godforhire\DatabaseNotifications;

class DatabaseMessage
{
    /**
     * The default user to send the notification to.
     *
     * @var string
     */
    protected $user = 1;

	/**
	 * The notificatoon data
	 *
	 * @var string
	 */
    protected $data;

    /**
     * Construct
     * @param string $data
     */
    public function __construct($data = '')
    {
        $this->data = $data;
    }

    /**
     * Create a message.
     *
     * @param string $data
     * @return static
     */
    public static function create($data = '')
    {
        return new static($data);
    }

    /**
     * Set the user
     *
     * @param string $value
     * @return $this
     */
    public function user($value)
    {
        $this->user = $value;
        return $this;
    }

    /**
     * Set the message data.
     *
     * @param string $value
     * @return $this
     */
    public function data($value)
    {
        $this->data = $value;
        return $this;
    }

    /**
     * Get the user id
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get message as array.
     *
     * @return array
     */
    public function toJson()
    {
        return json_encode($this->data);
    }
}