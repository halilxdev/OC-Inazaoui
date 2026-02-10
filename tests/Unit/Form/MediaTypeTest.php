<?php

namespace App\Tests\Form;

use App\Form\MediaType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

class MediaTypeTest extends KernelTestCase
{
    private FormFactoryInterface $formFactory;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->formFactory = static::getContainer()->get(FormFactoryInterface::class);
    }

    public function testFormFieldsWhenNotAdmin(): void
    {
        $form = $this->formFactory->create(MediaType::class, null, ['is_admin' => false]);

        $this->assertTrue($form->has('file'));
        $this->assertTrue($form->has('title'));
        $this->assertFalse($form->has('user'));
        $this->assertFalse($form->has('album'));
    }

    public function testFormFieldsWhenAdmin(): void
    {
        $form = $this->formFactory->create(MediaType::class, null, ['is_admin' => true]);

        $this->assertTrue($form->has('file'));
        $this->assertTrue($form->has('title'));
        $this->assertTrue($form->has('user'));
        $this->assertTrue($form->has('album'));
    }
}