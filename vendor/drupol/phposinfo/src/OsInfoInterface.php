<?php

declare(strict_types=1);

namespace drupol\phposinfo;

/**
 * Interface OsInfoInterface.
 */
interface OsInfoInterface
{
    /**
     * @return string
     */
    public static function arch(): string;

    /**
     * @return string
     */
    public static function family(): string;

    /**
     * @return string
     */
    public static function hostname(): string;

    /**
     * @return bool
     */
    public static function isApple(): bool;

    /**
     * @return bool
     */
    public static function isBSD(): bool;

    /**
     * @param int|string $family
     *
     * @return bool
     */
    public static function isFamily($family): bool;

    /**
     * @param int|string $os
     *
     * @return bool
     */
    public static function isOs($os): bool;

    /**
     * @return bool
     */
    public static function isUnix(): bool;

    /**
     * @return bool
     */
    public static function isWindows(): bool;

    /**
     * @return string
     */
    public static function os(): string;

    /**
     * Register new constants.
     */
    public static function register(): void;

    /**
     * @return string
     */
    public static function release(): string;

    /**
     * @return string
     */
    public static function version(): string;
}
