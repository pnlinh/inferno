<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WatchdogPageTest extends DuskTestCase
{
    private $pageUrl;

    function __construct()
    {
        $this->pageUrl = '/config/activities';
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1))
                ->visit($this->pageUrl)
                ->assertSee('My activities');
        });
    }

    /**
     * Test on search the text value continues to remain in the text box
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testSearchTextRemains()
    {
        $searchText = 'Hello world';
        $this->browse(function ($browser) use ($searchText) {
            $browser->visit($this->pageUrl)
                ->type('search_text', $searchText)
                ->click('.btn-success')
                ->assertPathIs($this->pageUrl)
                ->assertSee('My activities')
                ->assertInputValue('search_text', $searchText);
        });
    }

    public function testFirstRowOfTableIsLoginEntry()
    {
        $this->browse(function ($browser) {
            $browser->visit($this->pageUrl);
        });
    }
}
