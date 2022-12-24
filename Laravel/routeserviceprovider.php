Route::middleware(['web', 'auth'])
->prefix('association')
->as('association.')
->namespace($this->namespace)
->group(base_path('routes/association.php'));