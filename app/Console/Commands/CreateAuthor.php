<?php

namespace App\Console\Commands;

use App\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class CreateAuthor extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-author {first_name} {last_name} {birthday} {biography} {gender} {place_of_birth}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new author, provide author first name, last name, birthday, biography, gender, place of birdth';

    /**
     * Execute the console command.
     */
    public function handle(ApiService $apiService)
    {
        $login = $apiService->login(config('q-api.credentials.email'), config('q-api.credentials.password'));
        if ($login) {
            $token = $login['token_key'];
            $author = $apiService->createAthor( $token, $this->argument('first_name'), $this->argument('last_name'), $this->argument('birthday'), $this->argument('biography'), $this->argument('gender'), $this->argument('place_of_birth'));

            return $author;
        } else {
            return false;
        }
    }
}
