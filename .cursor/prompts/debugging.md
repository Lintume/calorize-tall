# Debugging & Common Issues

## Dev Tools

### Laravel Debugbar
Enabled in development. Shows:
- Queries (check N+1 problems)
- Route info
- Session data
- Request/Response details

### Laravel Pail (Log Tailing)
```bash
php artisan pail --timeout=0
```
Shows real-time logs with pretty formatting.

### Tinker
```bash
php artisan tinker
```
Interactive REPL for testing queries:
```php
>>> Product::search('apple')->get()
>>> User::find(1)->foodIntakes
```

## Common Issues

### Livewire Component Not Updating

1. **Check wire:model binding**:
   ```blade
   wire:model="property"        <!-- Updates on blur -->
   wire:model.live="property"   <!-- Updates on input -->
   wire:model.blur="property"   <!-- Explicit blur -->
   ```

2. **Alpine.js state not syncing**:
   Use `$wire` to communicate:
   ```javascript
   this.$wire.on('eventName', data => {
       this.alpineState = data;
   });
   ```

3. **Component not re-rendering**:
   Use unique `wire:key`:
   ```blade
   <livewire:component wire:key="unique-{{ Str::random() }}" />
   ```

### Translation Not Working

1. Check key exists in both `en.json` and `uk.json`
2. Clear cache: `php artisan cache:clear`
3. Re-export: `php artisan translatable:export uk,en`

### FULLTEXT Search Issues

MySQL FULLTEXT has minimum word length (default 4 chars).
Short words use LIKE fallback:
```php
->orWhere('title', 'LIKE', '%' . $search . '%')
```

### Asset Changes Not Reflecting

```bash
npm run dev    # Development with HMR
npm run build  # Production build
```

Clear Vite cache: delete `public/build` and rebuild.

### Session/Auth Issues

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Database Query Debugging

```php
// Log all queries
DB::enableQueryLog();
// ... your code ...
dd(DB::getQueryLog());

// Log single query
Product::search('test')->toSql();
```

## Logging

Log levels in `storage/logs/laravel.log`:
```php
Log::debug('Debug info', ['data' => $data]);
Log::info('Information');
Log::warning('Warning');
Log::error('Error', ['exception' => $e]);
```

## Performance

### N+1 Query Prevention
Always eager load relationships:
```php
Product::with('ingredients')->get();
Auth::user()->foodIntakes()->with('product')->get();
```

### Caching
```php
Cache::remember('key', 3600, function () {
    return expensive_operation();
});
```

## Browser Console

For Alpine.js debugging:
```javascript
// In browser console
Alpine.store('storeName')
document.querySelector('[x-data]').__x.$data
```

## Livewire Debugging

```blade
{{-- Show component state --}}
@dump($this->property)

{{-- In PHP --}}
logger($this->property);
```

