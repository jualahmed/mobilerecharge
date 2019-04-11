<?php
namespace Aloha\Twilio;

use InvalidArgumentException;

class Manager implements TwilioInterface
{
    /**
     * @var string
     */
    protected $default;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @param string $default
     * @param array $settings
     */
    public function __construct($default, array $settings)
    {
        $this->default = $default;
        $this->settings = $settings;
    }

    /**
     * @param string $connection
     *
     * @return \Aloha\Twilio\TwilioInterface
     */
    public function from($connection)
    {
        if (!isset($this->settings[$connection])) {
            throw new InvalidArgumentException("Connection \"$connection\" is not configured.");
        }

        $settings = $this->settings[$connection];

        return new Twilio($settings['sid'], $settings['token'], $settings['from']);
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return \Twilio\Rest\Api\V2010\Account\MessageInstance
     */
    public function message($to, $message)
    {
        return call_user_func_array([$this->defaultConnection(), 'message'], func_get_args());
    }

    /**
     * @param string $to
     * @param string|callable $message
     *
     * @return \Twilio\Rest\Api\V2010\Account\CallInstance
     */
    public function call($to, $message)
    {
        return call_user_func_array([$this->defaultConnection(), 'call'], func_get_args());
    }

    /**
     * @return \Aloha\Twilio\TwilioInterface
     */
    public function defaultConnection()
    {
        return $this->from($this->default);
    }

    /**
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        return call_user_func_array([$this->defaultConnection(), $method], $arguments);
    }
}
