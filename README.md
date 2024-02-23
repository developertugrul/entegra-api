# Entegra API

Bu kütüphane Entegra E-ticaret Yazılımını kullanan firmaların ürünlerini çekmek için kullanılır.

## Kurulum

```bash
composer require developertugrul/entegra-api
```

Kernel.php dosyasında middleware ekleyin.

```php
protected $routeMiddleware = [
    // ...
    'checkEntegraToken' => \Developertugrul\EntegraApi\Middleware\CheckToken::class,
];
```

.env dosyasına entegra kullanıcı adı ve şifresi ekleyin.

```env
ENTEGRA_API_USERNAME=apitestv2@entegrabilisim.com
ENTEGRA_API_PASSWORD=apitestv2
```

Run migrations

```bash
php artisan vendor:publish --provider="Developertugrul\EntegraApi\EntegraApiServiceProvider" --tag="migrations"
php artisan migrate
```

## Kullanım

```php
use Developertugrul\EntegraApi;

$entegra = new EntegraApi();

```

## Metodlar

### Ürün listesi çekme

Entegra'dan ürünleri çeker.

```php
$products = $entegra->products()->get();

// ID ile ürün çekme
$product = $entegra->products()->get(1);

// api_sync parametresi ile sadece api_sync=1 olan ürünleri çekme
$products = $entegra->products()->getWithParameter(1);

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

