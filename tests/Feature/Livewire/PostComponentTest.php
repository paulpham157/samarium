<?php
 
namespace Tests\Feature\Livewire;
 
use App\Livewire\Cms\Dashboard\PostComponent;
use Tests\TestCase;

use App\User;
 
class PostComponentTest extends TestCase
{
    public function test_component_exists_on_the_page()
    {
        $user = User::where('role', 'admin')->first();;

        $this->actingAs($user)
            ->get('/cms/post')
            ->assertSeeLivewire(PostComponent::class);
    }
}
