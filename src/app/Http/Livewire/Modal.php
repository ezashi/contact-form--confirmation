namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use App\Models\Category;

class Modal extends Component
{
    public $showModal = false;
    public $contact;

    protected $listeners = ['showContactDetail'];

    public function showContactDetail($contactId)
    {
        $this->contact = Contact::find($contactId);
        $this->openModal();
    }

    public function render()
    {
        return view('livewire.modal', [
            'categories' => Category::pluck('name', 'id')->toArray(),
        ]);
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}