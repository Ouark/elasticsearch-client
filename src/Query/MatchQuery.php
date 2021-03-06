<?php

namespace Novaway\ElasticsearchClient\Query;

//https://www.elastic.co/guide/en/elasticsearch/reference/5.6/query-dsl-match-query.html
class MatchQuery implements Query
{
    /** @var string */
    private $combiningFactor;
    /** @var string */
    private $field;
    /** @var mixed */
    private $value;
    /** @var array  */
    private $options;

    public function __construct(string $field, $value, string $combiningFactor = CombiningFactor::MUST, array $options = ['operator' => 'AND'])
    {
        $this->field = $field;
        $this->value = $value;
        $this->combiningFactor = $combiningFactor;
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getCombiningFactor(): string
    {
        return $this->combiningFactor;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function formatForQuery(): array
    {
        return [
                'match' => [
                    $this->getField() =>  array_merge([
                        'query' => $this->getValue()
                    ], $this->options)
                ]
            ];
    }


}
