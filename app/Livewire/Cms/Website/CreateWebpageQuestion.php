<?php

namespace App\Livewire\Cms\Website;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Cms\Webpage\WebpageQuestion;

class CreateWebpageQuestion extends Component
{
    public $webpage;

    public $writer_name; 
    public $writer_email; 
    public $writer_phone; 
    public $question_text; 

    public function render(): View
    {
        return view('livewire.cms.website.create-webpage-question');
    }

    public function store(): void
    {
        $validatedData = $this->validate([
            'writer_name' => 'nullable',
            'writer_email' => 'required|email',
            'writer_phone' => 'required',
            'question_text' => 'required|string',
        ]);

        $validatedData['webpage_id'] = $this->webpage->webpage_id;

        WebpageQuestion::create($validatedData);
        $this->resetInputFields();
        session()->flash('message', 'Enquiry sumbmitted');
    }

    public function resetInputFields(): void
    {
        $this->writer_name = '';
        $this->writer_email = '';
        $this->writer_phone = '';
        $this->question_text = '';
    }
}
