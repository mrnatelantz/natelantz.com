<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use RadCms\Media\Models\Media;

class MediaTest extends TestCase
{

    use WithoutMiddleware, DatabaseTransactions;

    /** @test */
    function it_creates_a_media_object()
    {
        $item = [
            'name' => 'default',
            'description' => 'Default image for testing',
            'type' => 'image',
            'item' => 'https://www.newton.ac.uk/files/covers/968361.jpg',
            'folder' => null
        ];
        $media = Media::create($item);

        $this->assertNotNull($media);
    }

    /** @test */
    function it_gets_a_media_object()
    {
        $item = [
            'name' => 'default',
            'description' => 'Default image for testing',
            'type' => 'image',
            'item' => 'https://www.newton.ac.uk/files/covers/968361.jpg',
            'folder' => null
        ];
        $mediaItem = Media::create($item);

        $media = Media::find($mediaItem->id);

        $this->assertEquals(
            ['id', 'name', 'description', 'type', 'item', 'folder', 'created_at', 'updated_at'],
            array_keys($media['attributes'])
        );

        $this->assertEquals(
            ['url', 'height', 'width'],
            array_keys((array)$media->item->small)
        );
    }

    /** @after */
    function removeUploadDir()
    {
        $this->rmdir_recursive(__DIR__ . '/../../../public/uploads');
    }
}
