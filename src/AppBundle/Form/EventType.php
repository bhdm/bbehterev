<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [ 'label' => 'Название'])
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'ШКОЛА ДЛЯ ПАЦИЕНТОВ' => 1,
                    'МЕЖДУНАРОДНАЯ ДЕЯТЕЛЬНОСТЬ' => 2
                ),
                'required'    => true,
                'label' => 'Тип мероприятия'
            ))
            ->add('category', null, [ 'label' => 'Категория'])
            ->add('specialties', null, [ 'label' => 'Специальности', 'attr' => ['class' => 'multiselect']])
            ->add('city', null, [ 'label' => 'Город'])
            ->add('adrs', null, [ 'label' => 'Адрес'])
            ->add('start', DateType::class, [ 'label' => 'Дата начала'])
            ->add('end',  DateType::class, [ 'label' => 'Дата окончания'])
            ->add('body', null, [ 'label' => 'Контент', 'attr' => ['class' => 'ckeditor']])
            ->add('enabled', ChoiceType::class, array(
                'choices' => array(
                    'Активная' => true,
                    'Неактивна' => false
                ),
                'required'    => true,
                'label' => 'Состояние'
            ));
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Event'
        ));
    }
}


//INSERT INTO user (username,       username_canonical, email,        email_canonical, enabled, salt,                            password,                                                  last_login, locked, expired, expires_at, confirmation_token, password_requested_at, roles, credentials_expired, credentials_expire_at, phone, lastName, firstName, surName, birthDate, sex, workPlace, workPlaceTitle, workPost, workTypeOrganization, certificateFile, certificateDate, academicDegree, university_id, country_id, city_id, specialty_id) VALUES (
//               "admin@admin.ru", "admin@admin.ru", "admin@admin.ru", "admin@admin.ru", 1, "i9ss081l9k8okgkwkkggck88kow0cw8", "$2y$13$ukYJNnpC315qm5do0cypSeZZ1ankdeUvPhDQWj3uVzTOmOlbWjoLu", null,      0,       0,        null,       null,                null,             "a:0:{}",          0,            null,              null,  'sd', 'sd', 'sd',           '2010-02-02', 1, null, null, null, null, "a:0:{}", null, null, null, null, null, null)