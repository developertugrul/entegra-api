# Entegra API

Bu kütüphane Entegra E-ticaret Yazılımını kullanan firmaların ürünlerini çekmek için kullanılır.

## Kurulum

```bash
composer require developertugrul/entegra-api
```


## Kullanım

```php
use Developertugrul\EntegraApi;

$entegra = new EntegraApi();

$products = $entegra->getProducts();
```

## Metodlar

### getProducts()

Entegra'dan ürünleri çeker.

```php
$products = $entegra->getProducts();
```

### getCategories()

Entegra'dan kategorileri çeker.

```php
$categories = $entegra->getCategories();
```

### getBrands()

Entegra'dan markaları çeker.

```php
$brands = $entegra->getBrands();
```

### getOrders()

Entegra'dan siparişleri çeker.

```php
$orders = $entegra->getOrders();
```

