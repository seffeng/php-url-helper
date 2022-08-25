## PHP Helpers

### 安装

```shell
# 安装
$ composer require seffeng/url-helper
```

### 目录说明

```
|---src
|   |   Url.php
|   |---Traits
|           UrlTrait.php
|---tests
|       UrlTest.php
```

### 示例

```php
/**
 * TestController.php
 * 示例
 */
namespace App\Http\Controllers;

use Seffeng\UrlHelper\Url;

class TestController extends Controller
{
    public function index()
    {
        $url = 'https://www.1kmi.com/view/2.php';
        print_r(Url::parseUrl($url));
    }
}
```

### 备注

1、更多示例请参考 tests 目录下测试文件。