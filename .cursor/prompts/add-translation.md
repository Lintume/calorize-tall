# Adding Translations

Calorize supports English (en) and Ukrainian (uk) languages.

## Adding a New Translatable String

1. **In Blade/PHP code**, wrap the string:
   ```blade
   {{ __('New text to translate') }}
   ```

2. **Add to translation files**:
   
   `resources/lang/en.json`:
   ```json
   {
     "New text to translate": "New text to translate"
   }
   ```
   
   `resources/lang/uk.json`:
   ```json
   {
     "New text to translate": "Новий текст для перекладу"
   }
   ```

## Auto-Export Translations

After adding new `__()` calls, export them:
```bash
php artisan translatable:export uk,en
```

This scans the codebase and adds missing keys to JSON files.

## Translation Keys Convention

- Use the English text as the key (not dot notation for simple strings)
- For namespaced keys, use dot notation: `'welcome.diary'`
- Keep keys readable and contextual

## Navigation & Menu Items

Navigation uses prefixed keys:
- `welcome.diary` → "Щоденник"
- `welcome.personal` → "Особисте"
- `auth.login` → "Увійти"

## Pluralization

For pluralized strings, use Laravel's trans_choice:
```php
trans_choice('product|products', $count)
```

## SEO Translations

Always translate meta descriptions and keywords:
```blade
@section('meta')
    <meta name="description" content="{{ __('Description text') }}">
    <meta name="keywords" content="{{ __('keyword1, keyword2') }}">
@endsection
```

