<?php

namespace Orchestra\Canvas\Tests\Feature\Generators;

class CastTest extends TestCase
{
    protected $files = [
        'app/Casts/FooBar.php',
    ];

    /** @test */
    public function it_can_generate_rule_file()
    {
        $this->artisan('make:cast', ['name' => 'FooBar'])
            ->assertExitCode(0);

        $this->assertFileContains([
            'namespace App\Casts;',
            'use Illuminate\Contracts\Database\Eloquent\CastsAttributes;',
            'class FooBar implements CastsAttributes',
            'public function get($model, string $key, $value, array $attributes)',
            'public function set($model, string $key, $value, array $attributes)',
        ], 'app/Casts/FooBar.php');
    }
}
