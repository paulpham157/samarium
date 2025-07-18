<?php

namespace App\Livewire\Cms\Dashboard\WebpageContentCreate;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Cms\Webpage\WebpageContent;

class YoutubeVideo extends Component
{
    public $webpage;

    public $youtube_video_id;

    public function render(): View
    {
        return view('livewire.cms.dashboard.webpage-content-create.youtube-video');
    }

    public function store(): void
    {
        $validatedData = $this->validate([
            'youtube_video_id' => 'required',
        ]);

        /* Prepare the content */
        $content = $this->prepareContent($validatedData);

        $webpageContent = new WebpageContent;

        $webpageContent->webpage_id = $this->webpage->webpage_id;
        $webpageContent->position = $this->webpage->getHighestContentPosition() + 1;
        $webpageContent->body = $content;
        $webpageContent->save();

        $this->dispatch('webpageContentCreateYoutubeVideoCompleted');
    }

    /* Prepare the content */
    public function prepareContent($validatedData): string
    {
        $content = '<div>';
        $content = $content . '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $validatedData['youtube_video_id'] . '"> </iframe>';
        $content = $content . '</div>';

        return $content;
    }
}
