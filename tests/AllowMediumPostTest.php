<?php

class AllowMediumPostTest extends TestCase
{
    /** @test */
    public function from_a_html_returns_without_the_javascript_file()
    {
        $htmlWithJsFile = $this->a_html_with_js_file();

        $transformed = \App\Actions\AllowMediumPost::transform($htmlWithJsFile);

        $this->assertSame($this->a_html_without_js_file(), $transformed);
    }

    /** @test */
    public function from_a_html_without_javascripts_returns_without_the_javascript_file()
    {
        $htmlWithoutJsFile = $this->a_html_without_js_file();

        $transformed = \App\Actions\AllowMediumPost::transform($htmlWithoutJsFile);

        $this->assertSame($htmlWithoutJsFile, $transformed);
    }

    private function a_html_with_js_file()
    {
        return "<html>
                    <head></head>
                    <body>
                    <script src='crazy-scripts/main.123456abcdef.js'/>
                    </body>
                </html>";

    }

    private function a_html_without_js_file()
    {
        return "<html>
                    <head></head>
                    <body>
                    <script src='crazy-scripts/'/>
                    </body>
                </html>";

    }
}
