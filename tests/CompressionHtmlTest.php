<?php

class CompressionHtmlTest extends TestCase
{
    /** @test */
    public function a_html_gets_compressed()
    {
        $plainHtml = $this->html_template();
        $compressed = \App\Actions\CompresionHtml::compress($plainHtml);

        $this->assertTrue(strlen($plainHtml) > strlen($compressed));
    }

    /** @test */
    public function a_html_compressed_gets_uncompressed()
    {
        $compressed = \App\Actions\CompresionHtml::compress($this->html_template());
        $uncompressed = \App\Actions\CompresionHtml::uncompress($compressed);

        $this->assertTrue(strlen($compressed) < strlen($uncompressed));
    }

    private function html_template()
    {
        return '<!doctype html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport"
                          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <title>Document</title>
                </head>
                <body>

                </body>
                </html>';
    }
}
