<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Model\ProductInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChanelProductPricingType
 * @package AppBundle\Form\Type
 */
class ChanelProductPricingType extends AbstractResourceType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chanel_code', HiddenType::class, [
                'data' => $options['channel']->getCode()
            ])
            ->add('price', MoneyType::class, [
                'label' => 'sylius.ui.price',
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
                'data' => 0
            ])
            ->add('originalPrice', MoneyType::class, [
                'label' => 'sylius.ui.original_price',
                'currency' => $options['channel']->getBaseCurrency()->getCode(),
                'data' => 0
            ]);

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options) {
            if (!$options['product']->getId()) {
                $event->setData(null);
            }
        });

        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($options): void {
            $data = $event->getData();
            $data->setProduct($options['product']);
            $event->setData($data);
        });
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);

        $resolver
            ->setRequired('channel')
            ->setAllowedTypes('channel', [ChannelInterface::class])
            ->setDefined('product')
            ->setAllowedTypes('product', ['null', ProductInterface::class])
            ->setDefaults([
                'label' => function (Options $options): string {
                    return $options['channel']->getName();
                },
            ]);
    }

    /**
     * @return null|string
     */
    public function getBlockPrefix()
    {
        return 'sylius_channel_product_pricing';
    }
}
