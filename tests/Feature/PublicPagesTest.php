<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_homepage_displays_required_sections(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Most Popular')
            ->assertSee('Latest Article')
            ->assertSee('Video');
    }

    public function test_information_pages_display_project_details(): void
    {
        $this->get(route('pages.about'))
            ->assertOk()
            ->assertSee('kesehatan adalah amanah')
            ->assertSee('setiap dua bulan');

        $this->get(route('pages.advertise'))
            ->assertOk()
            ->assertSee('advertising@healthcare.com');

        $this->get(route('pages.magazine'))
            ->assertOk()
            ->assertSee('Indonesia Healthcare Magazine');

        $this->get(route('pages.contact'))
            ->assertOk()
            ->assertSee('redaksi@healthcare.id')
            ->assertSee('+62 812-8906-2919')
            ->assertSee('Tangerang Selatan 15415');
    }

    public function test_pharmacy_rubric_page_loads(): void
    {
        $this->get(route('rubrics.show', 'pharmacy'))
            ->assertOk()
            ->assertSee('Pharmacy');
    }
}
