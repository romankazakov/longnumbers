<?php

namespace Integration;

use DateTime;
use Exception;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use \Integration\DataProviderInterface;

class CachedDataProvider implements DataProviderInterface
{
    private $cache;
    private $logger;
    private $dataProvider;

    public function __construct(
    	DataProviderInterface $dataProvider, 
    	CacheItemPoolInterface $cache,
    	LoggerInterface $logger)
    {
        $this->dataProvider = $dataProvider;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    public function getProvidedData(array $request)
    {
        $result = [];
        try {
            $cacheKey = $this->cache->getCacheKey($request);
            $cacheItem = $this->cache->getItem($cacheKey);
            
            if ($cacheItem->isHit()) {
                $result = $cacheItem->get();
            } else {
                $result = $this->dataProvider->getProvidedData($request);

                $cacheItem
                    ->set($result)
                    ->expiresAt(
                        (new DateTime())->modify('+1 day')
                    );
            }
        } catch (Exception $e) {
            $this->logger->critical('Error');
        }
        return $result;
    }
}
