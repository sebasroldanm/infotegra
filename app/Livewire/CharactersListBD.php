<?php

namespace App\Livewire;

use App\Models\Character;
use Livewire\Component;
use Livewire\WithPagination;

class CharactersListBD extends Component
{
    use WithPagination;

    public $editingCharacter = null;
    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'editingCharacter.name'     => 'required',
        'editingCharacter.status'   => 'required',
        'editingCharacter.species'  => 'required',
        'editingCharacter.type'     => 'nullable',
        'editingCharacter.gender'   => 'required',
    ];

    public function editDetails($characterId)
    {
        $this->editingCharacter = Character::find($characterId)->toArray();
    }

    public function updateCharacter()
    {
        $this->validate();

        Character::find($this->editingCharacter['id'])->update([
            'name'      => $this->editingCharacter['name'],
            'status'    => $this->editingCharacter['status'],
            'species'   => $this->editingCharacter['species'],
            'type'      => $this->editingCharacter['type'],
            'gender'    => $this->editingCharacter['gender'],
        ]);

        $this->closeModal();
        session()->flash('message', 'Personaje actualizado exitosamente.');
    }

    public function closeModal()
    {
        $this->editingCharacter = null;
    }

    public function render()
    {
        $characters = Character::paginate(10);

        return view('livewire.characters-list-b-d', compact('characters'));
    }
}
