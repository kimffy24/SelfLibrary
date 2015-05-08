<?php
namespace SelfLibrary\Ddd\Aggregate\Utils;

interface AggregateAwareInterface {
	public function setAggregate(AggregateInterface $a);
	public function getAggregate();
}