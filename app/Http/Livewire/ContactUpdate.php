<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactUpdate extends Component
{
    public $contactId;

    public $name;

    public $phone;

    protected $listeners = [
        'getContact' => 'showContact',
    ];

    public function showContact($contact)
    {
        $this->name = $contact['name'];

        $this->phone = $contact['phone'];

        $this->contactId = $contact['id'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3|string',
            'phone' => 'required|max:13|string',
        ]);

        if ($this->contactId) {
            $contact = Contact::findOrFail($this->contactId);

            $contact->update([
                'name' => $this->name,
                'phone' => $this->phone,
            ]);
        }

        $this->resetInput();

        $this->emit('contactUpdated', $contact);
    }

    private function resetInput()
    {
        $this->name = null;
        $this->phone = null;
    }

    public function render()
    {
        return view('livewire.contact-update');
    }
}
