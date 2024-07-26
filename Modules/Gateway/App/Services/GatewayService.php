<?php

namespace Modules\Gateway\App\Services;

class GatewayService
{
    /**
     * Payment Driver Name.
     *
     * @var string
     */
    protected $driver;


    /**
     * Sms Driver Instance.
     *
     * @var object
     */
    protected $driverInstance;

    /**
     * @var int
     */
    protected $amount;

    /**
     * Payment Driver Settings.
     *
     * @var array
     */
    protected $settings;

    /**
     * invoice's transaction id
     *
     * @var string
     */
    protected $transactionId;


    /**
     * PaymentManager constructor.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    public function __construct(array $config = [])
    {
        $this->via(config('gateway.default'));
    }


    protected function getFreshDriverInstance()
    {
        $class = config('gateway.map')[$this->driver];
        return new $class();
    }

    /**
     * Set transaction's id
     *
     * @param $id
     *
     * @return $this
     */
    public function transactionId($id)
    {
        $this->transactionId = $id;

        return $this;
    }


    public function via($driver)
    {
        $this->driver = $driver;
        $this->settings = array_merge(config('gateway')['drivers'][$driver] ?? []);
        return $this;
    }

    public function purchase($amount, $finalizeCallback)
    {

        if ($amount) {
            $this->invoice($amount);
        }

        $this->driverInstance = $this->getFreshDriverInstance();

        $transactionId = $this->driverInstance->purchase($amount, $this->settings);

        $this->transactionId = $transactionId;

        if ($finalizeCallback) {
            call_user_func_array($finalizeCallback, [$this->driverInstance, $transactionId]);
        }

        return $this;
    }

    /**
     * Pay the purchased invoice.
     *
     * @param $initializeCallback|null
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function pay($initializeCallback = null)
    {
        $this->driverInstance = $this->getDriverInstance();

        if ($initializeCallback) {
            call_user_func($initializeCallback, $this->driverInstance);
        }

        return $this->driverInstance->pay($this->transactionId, $this->settings);
    }

    /**
     * Retrieve current driver instance or generate new one.
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getDriverInstance()
    {
        if (!empty($this->driverInstance)) {
            return $this->driverInstance;
        }

        return $this->getFreshDriverInstance();
    }

    /**
     * Set payment amount.
     *
     * @param $amount
     * @return $this
     * @throws \Exception
     */
    public function invoice($amount)
    {
        $this->amount = $amount;

        return $this;
    }
}
