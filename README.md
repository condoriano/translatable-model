# Translatable Model

Предоставляет методы для простой работы с мультиязычными моделями Eloquent.


```php

use Condoriano\TranslatableModel\EloquentTrait as Translatable;

class Article extends Eloquent {

	use Translatable;

	# указываем какие аттрибуты мы хотим переводить
	public $translatedAttributes = ['title', 'content'];

	# модель с полями
	public $title_ru;
	public $title_en;
	public $content_ru;
	public $content_en;

}
```

### Чтение и изменение значения переводимых полей

```php
# возвращает заголовок статьи на языке установленном по-умолчанию
$article->i18n->title # == $article->title_ru

# меняем локаль на английскую
App::setLocale('en');

# возвращает заголовок статьи на английском языке
$article->i18n->title # == $article->title_en

# изменение происходит привычным образом
$article->i18n->title = "New article title"; # $article->title_en == 'New article title';
```

### Массовое заполнение

```php

App::setLocale('en');

$article->i18n->fill([
	'title' => 'Article title'
]);

# меняем локаль на русскую
App::setLocale('ru');

$article->i18n->fill([
	'title' => 'Заголовок статьи'
]);

$article->title_en == 'Article title';
$article->title_ru == 'Заголовок статьи';
```