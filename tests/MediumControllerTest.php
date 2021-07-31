<?php

class MediumControllerTest extends TestCase
{
    /** @test */
    public function an_medium_url_is_showed()
    {
        $response = $this->get('medium?url=https://www.medium.com');

        $response->seeStatusCode(200);
    }

    /** @test */
    public function an_medium_url_is_cached()
    {
        $response = $this->get('medium?url=https://www.medium.com');

        $response->seeStatusCode(200);
        $this->assertNotNull(\Illuminate\Support\Facades\Cache::get('https://www.medium.com'));
    }

    /** @test */
    public function an_medium_cached_is_showed_without_visit_curl()
    {
        $htmlCached = '<html></html>';
        $compressed = \App\Actions\CompresionHtml::compress($htmlCached);
        \Illuminate\Support\Facades\Cache::put('https://www.medium.com', $compressed);
        $response = $this->get('medium?url=https://www.medium.com');

        $response->seeStatusCode(200);
        $this->assertSame($htmlCached,trim($response->response->content()));
    }

    /** @test */
    public function a_not_medium_url_cannot_be_showed()
    {
        $response = $this->get('medium?url=https://www.google.com');

        $response->response->assertJson(["url" => [
            "The url provided is not in the Medium IPs Range"
        ]]);
        $response->seeStatusCode(422);
    }

    /** @test */
    public function a_not_url_cannot_be_showed()
    {
        $response = $this->get('medium?url=this-is-not-a-url');

        $response->response->assertJson(["url" => [
            "The url format is invalid.",
            "The url provided is not in the Medium IPs Range"
        ]]);
        $response->seeStatusCode(422);
    }
}
