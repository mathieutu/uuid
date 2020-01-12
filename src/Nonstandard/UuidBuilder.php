<?php

/**
 * This file is part of the ramsey/uuid library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Uuid\Nonstandard;

use Ramsey\Uuid\Builder\UuidBuilderInterface;
use Ramsey\Uuid\Codec\CodecInterface;
use Ramsey\Uuid\Converter\NumberConverterInterface;
use Ramsey\Uuid\Converter\TimeConverterInterface;
use Ramsey\Uuid\Math\CalculatorInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * Nonstandard\UuidBuilder builds instances of Nonstandard\Uuid
 *
 * @psalm-immutable
 */
class UuidBuilder implements UuidBuilderInterface
{
    /**
     * @var NumberConverterInterface
     */
    private $numberConverter;

    /**
     * @var TimeConverterInterface
     */
    private $timeConverter;

    /**
     * @var CalculatorInterface
     */
    private $calculator;

    /**
     * @param NumberConverterInterface $numberConverter The number converter to
     *     use when constructing the Nonstandard\Uuid
     * @param TimeConverterInterface $timeConverter The time converter to use
     *     for converting timestamps extracted from a UUID to Unix timestamps
     * @param CalculatorInterface $calculator The calculator to use for
     *     performing mathematical operations on UUIDs
     */
    public function __construct(
        NumberConverterInterface $numberConverter,
        TimeConverterInterface $timeConverter,
        CalculatorInterface $calculator
    ) {
        $this->numberConverter = $numberConverter;
        $this->timeConverter = $timeConverter;
        $this->calculator = $calculator;
    }

    /**
     * Builds and returns a Nonstandard\Uuid
     *
     * @param CodecInterface $codec The codec to use for building this instance
     * @param string[] $fields An array of fields from which to construct an instance.
     *
     * @return Uuid The Nonstandard\UuidBuilder returns an instance of
     *     Nonstandard\Uuid
     */
    public function build(CodecInterface $codec, array $fields): UuidInterface
    {
        return new Uuid(
            $fields,
            $this->numberConverter,
            $codec,
            $this->timeConverter,
            $this->calculator
        );
    }
}
