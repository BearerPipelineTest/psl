<?php

declare(strict_types=1);

namespace Psl\Json;

use JsonException;
use Psl\Str;

use function json_decode;

use const JSON_BIGINT_AS_STRING;
use const JSON_THROW_ON_ERROR;

/**
 * Decode a json encoded string into a dynamic variable.
 *
 * @return mixed
 *
 * @psalm-pure
 *
 * @throws Exception\DecodeException If an error occurred.
 */
function decode(string $json, bool $assoc = true)
{
    try {
        /** @var mixed $value */
        $value = json_decode(
            $json,
            $assoc,
            512,
            JSON_BIGINT_AS_STRING | JSON_THROW_ON_ERROR,
        );
    } catch (JsonException $e) {
        throw new Exception\DecodeException(Str\format('%s.', $e->getMessage()), (int)$e->getCode(), $e);
    }

    return $value;
}
