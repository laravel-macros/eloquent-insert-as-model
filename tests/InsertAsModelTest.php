<?php

namespace LaravelMacros\Eloquent\Tests;

use LaravelMacros\Eloquent\Tests\Models\User;

class InsertAsModelTest extends TestCase
{
    /** @test */
    public function it_handles_casted_attributes()
    {
        User::insertAsModel([
            [
                'options' => ['sms' => true],
                'shelf'   => collect(['book1', 'book2', 'book3']),
            ],
            [
                'options' => ['sms' => false],
                'shelf'   => collect(['book1', 'book2']),
            ],
        ]);

        $this->assertCount(2, User::all());
        $this->assertSame(User::find(1)->options, ['sms' => true]);
        $this->assertSame(User::find(2)->options, ['sms' => false]);
        $this->assertSame(User::find(1)->shelf->toArray(), ['book1', 'book2', 'book3']);
        $this->assertSame(User::find(2)->shelf->toArray(), ['book1', 'book2']);
    }

    /** @test */
    public function it_handles_mutated_attributes()
    {
        User::insertAsModels([
            [
                'username' => 'Mohannad Naj',
            ],
        ]);

        $this->assertCount(1, User::all());
        $this->assertSame('mohannad-naj', User::find(1)->username);
    }

    /** @test */
    public function it_handles_insert_without_entries()
    {
        User::insertAsModel([]);

        $this->assertCount(0, User::all());
    }

    /** @test */
    public function it_handles_insert_with_single_entry()
    {
        User::insertAsModels([
            'username' => 'Mohannad Naj',
        ]);

        $this->assertSame('mohannad-naj', User::find(1)->username);
    }
}
