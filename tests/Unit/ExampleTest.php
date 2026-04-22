<?php

<<<<<<< HEAD
test('that true is true', function () {
    expect(true)->toBeTrue();
});
=======
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}
>>>>>>> 204b275a6060ddd2972c2a14cbc0149a4c0b2500
