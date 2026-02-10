<?php

namespace App\Tests\Form;

use App\Entity\Album;
use App\Form\AlbumType;
use Symfony\Component\Form\Test\TypeTestCase;

class AlbumTypeTest extends TypeTestCase
{
    public function testSubmitValidData(): void
    {
        $formData = [
            'name' => 'Mon Album',
        ];
        $album = new Album();
        $form = $this->factory->create(AlbumType::class, $album);

        $expected = new Album();
        $expected->setName('Mon Album');
        $form->submit($formData);
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected->getName(), $album->getName());

        $view = $form->createView();
        $children = $view->children;
        $this->assertArrayHasKey('name', $children);
    }

    public function testFormHasCorrectFields(): void
    {
        $form = $this->factory->create(AlbumType::class);

        $this->assertTrue($form->has('name'));
        $this->assertCount(1, $form->all());
    }

    public function testSubmitEmptyData(): void
    {
        $form = $this->factory->create(AlbumType::class);
        $form->submit([]);
        $this->assertTrue($form->isSynchronized());
    }
}