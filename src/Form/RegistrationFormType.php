<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("email",EmailType::class,['attr'=>['class' => 'form-input','placeholder'=>"Votre Email"]])
            ->add('nom',TextType::class,['attr'=>['class' => 'form-input','placeholder'=>"Saisir Votre Nom"]])
            ->add('prenom',null,['attr'=>['class' => 'form-input','placeholder'=>"Saisir Votre Prenom"]])
            ->add('age',IntegerType::class,['attr'=>['class' => 'form-input','placeholder'=>"Specifier votre Age"]])
            ->add('cin',TextType::class,['attr'=>['class' => 'form-input','placeholder'=>"Saisir votre CIN"]])
            ->add('numtel',TextType::class,['attr'=>['class' => 'form-input','placeholder'=>"Saisir Votre Numero de telephone"]])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (JPG or PNG)',
                'required' => true,
                'allow_delete' => true,
                'download_uri' => false,
    
            ])  
             ->add('plainPassword', PasswordType::class, [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'mapped' => false,
                    'attr' => ['class'=>'form-input','autocomplete' => 'new-password','placeholder'=>'Saisir Votre Mot De Passe'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    ])
                    
                    
            ->add('sexe', ChoiceType::class, array(
                        'choices'  => array(
                            'Male' => 'male',
                            'Female' => 'female',
                        ),
                        'expanded' => false,
                        'multiple' => false,
                        'attr'=>['class' => 'form-input','placeholder'=>"Age"]
                        ))
            ->add('agreeTerms', CheckboxType::class, [
                            'mapped' => false,
                            'constraints' => [
                                new IsTrue([
                                    'message' => 'You should agree to our terms.',
                                ]),
                            ],
            ])
            ->add('Register',SubmitType::class,['attr'=>['class' => 'form','placeholder'=>"Register"]])       ;
        }
        
        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Utilisateur::class,
            ]);
        }
}
