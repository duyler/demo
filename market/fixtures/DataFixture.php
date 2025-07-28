<?php

declare(strict_types=1);

namespace DataFixtures;

use Cycle\ORM\EntityManager;
use Cycle\ORM\ORMInterface;
use Duyler\ORM\Fixture\FixtureInterface;
use Faker\Factory;
use Market\Application\Config\AuthConfig;
use Market\Domain\Entity\Cart;
use Market\Domain\Entity\CartItem;
use Market\Domain\Entity\Discount;
use Market\Domain\Entity\Product;
use Market\Domain\Entity\User;
use Money\Money;
use Ramsey\Uuid\Uuid;

class DataFixture implements FixtureInterface
{
    private AuthConfig $authConfig;

    public function __construct()
    {
        $this->authConfig = new AuthConfig(
            defaultUserId: '0196ec04-9e4e-714f-b36f-8efed52183d7',
        );
    }

    public function load(ORMInterface $orm): void
    {
        $faker = Factory::create();

        $manager = new EntityManager($orm);

        $users = [];

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setUsername($faker->userName())
                ->setEmail($faker->email());

            $users[] = $user;
            $manager->persist($user);
            echo 'User id: ' . $user->getId()->toString() . "\n";
        }

        $defaultUser = new User();
        $defaultUser->setUsername($faker->userName())
            ->setEmail($faker->email())
            ->setId(Uuid::fromString($this->authConfig->defaultUserId));

        $manager->persist($defaultUser);

        $users[] = $defaultUser;

        /** @var Product[] $products */
        $products = [];

        for ($i = 0; $i < 1000; $i++) {
            $product = new Product();
            $product->setTitle($faker->company())
                ->setPrice(Money::USD(rand(100, 1000)))
                ->setImage('/img/product.png');

            $products[] = $product;
            $manager->persist($product);
        }

        foreach ($users as $user) {
            $cart = new Cart();
            $cart->setUserId($user->getId());
            $cart->setId($user->getId());

            $manager->persist($cart);

            $cartItemsCount = rand(1, 20);

            for ($i = 0; $i < $cartItemsCount; $i++) {
                $cartItem = new CartItem();
                $cartItem->setProductId($products[$i]->getId());
                $cartItem->setCartId($cart->getId());
                $cartItem->setQuantity(rand(1, 10));
                $cartItem->setUserId($user->getId());

                $manager->persist($cartItem);
            }
            $discount = new Discount();
            $discount->setUserId($user->getId());
            $discount->setPercentage(rand(1, 20));

            $manager->persist($discount);
        }

        $manager->run();
    }
}
