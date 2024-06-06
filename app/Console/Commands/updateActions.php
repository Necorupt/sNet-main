<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActionType;

use function Psy\debug;

class updateActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:actions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update actions table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ActionTypes = config('Actions');
        $actionFlag = 1;
        foreach($ActionTypes as $action){
            
            $this->info('Generate action for '.$action . ' action flag = ' .$actionFlag);
            ActionType::create(["name" => $action , "value" => $actionFlag]);
            $actionFlag = $actionFlag << 1;
            
        }
    }
}
