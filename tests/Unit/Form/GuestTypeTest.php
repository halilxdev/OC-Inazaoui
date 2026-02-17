<?php

namespace App\Tests\Form;

use App\Form\GuestType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormFactoryInterface;

class GuestTypeTest extends KernelTestCase
{
    private FormFactoryInterface $formFactory;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->formFactory = static::getContainer()->get(FormFactoryInterface::class);
    }

    public function testFormFields(): void
    {
        $form = $this->formFactory->create(GuestType::class, null);
        $this->assertTrue($form->has('name'));
        $this->assertTrue($form->has('email'));
        $this->assertTrue($form->has('description'));
        $this->assertTrue($form->has('password'));
        $this->assertTrue($form->has('roles'));
    }
}