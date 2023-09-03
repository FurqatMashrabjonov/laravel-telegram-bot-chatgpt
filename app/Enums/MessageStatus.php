<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MessageStatus extends Enum
{
    const NOT_SENT = 'not_sent';
    const SENT = 'sent';
    const READY_TO_SENT = 'ready_to_sent';
}
