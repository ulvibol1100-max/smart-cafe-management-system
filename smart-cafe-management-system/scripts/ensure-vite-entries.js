import { existsSync, mkdirSync, writeFileSync } from 'node:fs';
import { dirname } from 'node:path';

const files = {
    'resources/css/app.css': `@import 'tailwindcss';

@source '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php';
@source '../../storage/framework/views/*.php';
@source '../**/*.blade.php';
@source '../**/*.js';
`,
    'resources/js/app.js': `// Frontend entry for Vite builds.
`,
};

for (const [path, contents] of Object.entries(files)) {
    if (! existsSync(path)) {
        mkdirSync(dirname(path), { recursive: true });
        writeFileSync(path, contents);
    }
}
