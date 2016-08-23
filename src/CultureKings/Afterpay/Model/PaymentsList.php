<?php

namespace CultureKings\Afterpay\Model;

/**
 * Class PaymentsList
 * @package CultureKings\Afterpay\Model
 */
class PaymentsList
{
    /**
     * @var int
     */
    protected $totalResults;
    /**
     * @var int
     */
    protected $offset;
    /**
     * @var int
     */
    protected $limit;
    /**
     * @var Payment[]
     */
    protected $results = [];

    /**
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * @param int $totalResults
     * @return $this
     */
    public function setTotalResults($totalResults)
    {
        $this->totalResults = $totalResults;

        return $this;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return Payment[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @param Payment[] $results
     * @return $this
     */
    public function setResults(array $results)
    {
        $this->results = $results;

        return $this;
    }
}
