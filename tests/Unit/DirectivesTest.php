<?php

namespace Tests\Unit;

use Tests\TestCase;

class DirectivesTest extends TestCase
{
    /** @test */
    public function it_compile_host_directive()
    {
        $blade = "@host('https://www.example.com/en/')";

        $code = app('blade.compiler')->compileString($blade);

        $this->assertEquals('example.com', $this->output($code));
    }

    /**
     * Get output of code.
     *
     * @param string $code
     * @return string
     */
    protected function output($code)
    {
        ob_start();

        eval('?>'.$code);

        $out = ob_get_contents();

        ob_end_clean();

        return $out;
    }
}
