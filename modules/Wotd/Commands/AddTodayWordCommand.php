<?php

namespace Wotd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Wotd\Services\WotdServiceUtils;

class AddTodayWordCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'wotd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch today english word";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $wotd = WotdServiceUtils::getWordOfTheDay();
        $data = [
            $wotd['date'] => [
                'word' => $wotd['word'],
                'meaning' => $wotd['meaning'],
                'url' => $wotd['url'],
                'date' => $wotd['date'],
                'created_at' => date_create(),
            ]
        ];
        DB::table('wotd')->insertOrIgnore($data);

        $this->line("Saved word of the day!");
    }
}
