<?php
namespace Tests\Admin\Responses\Repositories;

use App\Admin\Responses\Repositories\ResponseRepository;
use Tests\Generator\Fixture\MetaData;
use Tests\TestCase;

class ResponseRepositoryTest extends TestCase
{
    public ResponseRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->app->get(ResponseRepository::class);
    }

    public function test_it_can_get_headers_by_meta_data()
    {
        $md = MetaData::get();
        $headers = $this->repository->getHeadersByMetaData($md);
        $this->assertCount(6, $headers);

        $this->assertArrayHasKey('label', head($headers));
        $this->assertArrayHasKey('id', head($headers));
    }

}