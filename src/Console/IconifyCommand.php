<?php

namespace Slowlyo\OwlAdmin\Console;

use Iconify\IconsJSON\Finder;
use Illuminate\Console\Command;

class IconifyCommand extends Command
{
    protected $signature = 'admin:iconify';

    protected $description = 'Generate iconify.json';

    public function handle(): void
    {
        // 取消内存限制
        ini_set('memory_limit', '-1');

        $filePath = storage_path('iconify.json');

        file_put_contents($filePath, '[');

        $files = collect(scandir(Finder::rootDir() . '/json'))
            ->filter(fn($i) => !in_array($i, ['.', '..']))
            ->values()
            ->all();

        foreach ($files as $index => $item) {
            $path    = Finder::locate(str_replace('.json', '', $item));
            $content = json_decode(file_get_contents($path), true);
            $prefix  = data_get($content, 'prefix', '');
            $icons   = array_keys(data_get($content, 'icons', []));
            $icons   = array_map(fn($i) => sprintf('"%s:%s"', $prefix, $i), $icons);

            if (count($icons) == 0) {
                continue;
            }

            if ($index != 0) {
                file_put_contents($filePath, ',', FILE_APPEND);
            }

            file_put_contents($filePath, implode(',', $icons), FILE_APPEND);
        }

        file_put_contents($filePath, ']', FILE_APPEND);
    }
}
