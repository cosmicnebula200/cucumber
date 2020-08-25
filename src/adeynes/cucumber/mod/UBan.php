<?php
declare(strict_types=1);

namespace adeynes\cucumber\mod;

use adeynes\cucumber\utils\Queries;
use poggit\libasynql\DataConnector;

class UBan extends IpPunishment
{

    public static function from(array $row): UBan
    {
        return new UBan($row['ip'], $row['reason'], $row['moderator'], $row['time_created']);
    }

    public function getFormatData(): array
    {
        return [
            'ip' => $this->getIp(),
            'reason' => $this->getReason(),
            'expiration' => 'the Big Crunch',
            'moderator' => $this->getModerator(),
            'time_created' => $this->getTimeOfCreationFormatted()
        ];
    }

    public function save(DataConnector $connector): void
    {
        $connector->executeInsert(
            Queries::CUCUMBER_PUNISH_UBAN,
            $this->getRawData()
        );
    }

}