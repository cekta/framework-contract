<?php

declare(strict_types=1);

namespace Cekta\Framework\Contract;

use ReflectionClass;

/**
 * @external
 */
interface Module
{
    /**
     * Returns container parameters (e.g., configuration parameters).
     * Called on every container request.
     *
     * @param mixed $cachedData cached data (result of getCacheableData)
     * @return array<string, mixed>
     */
    public function onCreateParameters(mixed $cachedData): array;

    /**
     * Returns service definitions for building (generating) the container class.
     * Called once when the container is being built (e.g., after cache invalidation).
     *
     * @param mixed $cachedData cached data
     * @return array{
     *     entries?: string[],
     *     alias?: array<string, string>,
     *     singletons?: string[],
     *     factories?: string[],
     * }
     */
    public function onBuildDefinitions(mixed $cachedData): array;

    /**
     * Called for each project class during the discovery phase.
     * Can be used to collect metadata.
     *
     * @param ReflectionClass<object> $class
     */
    public function discover(ReflectionClass $class): void;

    /**
     * Returns serializable module state for caching.
     * The result must be successfully json_encode-able.
     * This data will later be passed as $cachedData to onCreateParameters and onBuildDefinitions.
     *
     * @return mixed
     */
    public function getCacheableData(): mixed;
}
