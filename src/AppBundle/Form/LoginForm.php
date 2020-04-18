<?php
/**
 *  Created with PhpStorm
 * by User: @hseka
 * Date : 18/04/2020
 * Time: 20:37
 **/

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginForm extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('_username')
      ->add('_password', PasswordType::class)
    ;
  }
}