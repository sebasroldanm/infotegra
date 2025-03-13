<?php

namespace App\Livewire;

use App\Models\Character;
use App\Models\Location;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CharactersList extends Component
{
    public $characters = [];
    public $selectedCharacter = null;
    public $infoApi = [];
    public $currentPage = 1;
    public $maxPages = 5;

    public function mount()
    {
        $this->fetchCharacters('https://rickandmortyapi.com/api/character');
    }

    public function fetchCharacters($url)
    {
        $response = Http::get($url);
        $this->infoApi = $response->json()['info'];
        $this->characters = $response->json()['results'];
    }

    public function showDetails($characterId)
    {
        $this->selectedCharacter = collect($this->characters)->firstWhere('id', $characterId);
    }

    public function nextPage()
    {
        if ($this->infoApi['next']) {
            $this->currentPage++;
            $this->fetchCharacters($this->infoApi['next']);
        }
    }

    public function prevPage()
    {
        if ($this->infoApi['prev']) {
            $this->currentPage--;
            $this->fetchCharacters($this->infoApi['prev']);
        }
    }

    public function closeModal()
    {
        $this->selectedCharacter = null;
    }

    public function render()
    {
        return view('livewire.characters-list');
    }

    public function saveData()
    {
        $allCharacters = [];
        $url = 'https://rickandmortyapi.com/api/character';

        for ($i = 1; $i <= 5; $i++) {
            $response = Http::get($url);
            $data = $response->json();
            $allCharacters = array_merge($allCharacters, $data['results']);
            $url = $data['info']['next'];
        }

        foreach ($allCharacters as $char) {
            try {
                if (empty($char['origin']['url'])) {
                    $location = false;
                } else {
                    $resp_location = Http::get($char['origin']['url']);
                    $data_location = $resp_location->json();
                    $location = Location::firstOrCreate(
                        ['name'         => $data_location['name']],
                        [
                            'type'         => $data_location['type'],
                            'dimension'    => $data_location['dimension'],
                        ],
                    );
                }
            } catch (\Throwable $th) {
                dd($char['origin']['url'] == 'unknown', $char);
            }

            $character = Character::find($char['id']);
            if (empty($character)) {
                $character = new Character();
            }
            $character->name = $char['name'];
            $character->status = $char['status'];
            $character->species = $char['species'];
            $character->type = $char['type'];
            $character->gender = $char['gender'];
            $character->image = $char['image'];
            if ($location != false) {
                $character->origin_location_id = $location->id;
            }
            $character->save();
        }
    }
}
