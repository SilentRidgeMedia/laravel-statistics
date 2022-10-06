<?php

namespace SilentRidge\Statistics\Services;

use SilentRidge\Statistics\Contracts\AggregationContract;
use SilentRidge\Statistics\Models\NormalizedStatistic;
use SilentRidge\Statistics\Models\RawStatistic;

class AggregationService implements AggregationContract
{
    private array $aggregations = [];

    public function aggregate(string $uuid, iterable $data): void
    {
        $normalizedStat = (new NormalizedStatistic);
        $rawStat = new RawStatistic();
        $userNormalizedStat = $normalizedStat->getByUuid($uuid)?->data;

        foreach ($data->map->data as $key => $datum) {
            foreach ($datum as $gameName => $stats) {

                if (empty($userNormalizedStat[$gameName])) {
                    $userNormalizedStat[$gameName] = $this->getStatTemplate($gameName);
                }

                $game = $userNormalizedStat[$gameName];

                if (!$game) {
                    $this->aggregations[$gameName] = [];
                    continue;
                }

                $game['game_played'] += $stats['game_played'];
                $game['has_won'] += $stats['has_won'];
                $game['current_streak'] = $stats['has_won']  != 0 ? $game['current_streak'] + 1 : 0;
                $game['max_streak'] = max($game['max_streak'], $game['current_streak']);
                $win_rate = round(floatval($game['has_won'] / $game['game_played']), 4);

                $game['win_rate'] = $win_rate  * 100;


                if ($gameName === 'wordle') {
                    $game['rows'] = $this->calculateWordleRows($game['rows'] , $stats['rows'] ?? []);
                }

                $userNormalizedStat[$gameName] = $game;
            }

            $this->aggregations = $userNormalizedStat;
        }

        $normalizedStat = (new NormalizedStatistic);
        $normalizedStat->remove($uuid);;
        $normalizedStat->store($uuid, $this->aggregations);
        $rawStat->remove($uuid);
    }

    private function getStatTemplate(string $gameName = '')
    {
        $template =  [
            'game_played'    => 0,
            'has_won'        => 0,
            'win_rate'       => 0,
            'current_streak' => 0,
            'max_streak'     => 0,
        ];

        if ($gameName === 'wordle') {
            $template['rows'] = [0, 0, 0, 0, 0, 0];
        }

        return $template;
    }

    private function calculateWordleRows($rows, $rawRowsInfo): array
    {
        if (empty($rows)) {
            $rows = [0, 0, 0, 0, 0, 0];
        }

        if (empty($rawRowsInfo)) {
            $rawRowsInfo = [0, 0, 0, 0, 0, 0];
        }

        $sumArray = [];

        foreach ($rows as $key => $value) {
            $sumArray[$key] = $value + $rawRowsInfo[$key];
        }

        return $sumArray;
    }
}
