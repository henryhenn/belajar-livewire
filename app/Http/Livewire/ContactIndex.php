<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{
    use WithPagination;

    public $paginate = 5;

    public $statusUpdate = false;

    public $search;

    protected $updatesQueryString = ['search'];

    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleUpdated',
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function handleStored($contact)
    {
        session()->flash('message', 'Contact ' . $contact['name'] . ' berhasil ditambahkan!');
    }

    public function handleUpdated($contact)
    {
        session()->flash('message', 'Contact ' . $contact['name'] . ' berhasil diupdate!');
    }

    public function getContact($id)
    {
        $this->statusUpdate = true;

        $contact = Contact::findOrFail($id);

        $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
            $contact = Contact::findOrFail($id);

            $contact->delete();

            session()->flash('message', 'Contact berhasil dihapus!');
        }
    }

    public function render()
    {
        return view('livewire.contact-index', [
            'contacts' => $this->search === null ?
                Contact::latest()->paginate($this->paginate) :
                Contact::latest()
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->paginate($this->paginate)
        ]);
    }
}
