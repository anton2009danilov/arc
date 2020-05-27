<?php

declare(strict_types=1);

namespace Service\Product;

use Model;
use Model\Entity\Product;
use Model\Repository\ProductRepository;

class ProductService
{
    /**
     * Получаем информацию по конкретному продукту
     * @param int $id
     * @return Product|null
     */
    public function getInfo(int $id): ?Product
    {
        $product = $this->getProductRepository()->search([$id]);
        return count($product) ? $product[0] : null;
    }

    /**
     * Получаем все продукты
     * @param string $sortType
     * @return Product[]
     */
    public function getAll(string $sortType): array
    {
        $productList = $this->getProductRepository()->fetchAll();

        // Применить паттерн Стратегия
        // $sortType === 'price'; // Сортировка по цене
        // $sortType === 'name'; // Сортировка по имени

        $sortedProductList = $this->sort($productList, $sortType);

        return $sortedProductList;
    }

    public function sort($productList, $sortType)
    {
        if ($sortType === 'name') {
            usort($productList, function ($a, $b) {
                return strcmp($a["name"], $b["name"]);
            });
        } elseif ($sortType === 'price') {
            usort($productList, function ($a, $b) {
                if ($a['price'] > $b['price']) {
                    return true;
                } else {
                    return false;
                }
            });

        } else {
            sort($productList);
        }

        return $productList;
    }


    /**
     * Фабричный метод для репозитория Product
     * @return ProductRepository
     */
    protected function getProductRepository(): ProductRepository
    {
        return new ProductRepository();
    }

}
