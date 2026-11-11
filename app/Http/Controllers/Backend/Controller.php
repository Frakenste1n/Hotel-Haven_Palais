<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

abstract class Controller extends BaseController
{
    protected function uniqueSlug(string $name, string $modelClass, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        if ($base === '') {
            $base = 'item';
        }

        $slug = $base;
        $suffix = 2;

        while ($modelClass::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    protected function emptyPage(int $perPage = 10): LengthAwarePaginator
    {
        return new LengthAwarePaginator([], 0, $perPage, 1, [
            'path' => request()->url(),
            'pageName' => 'page',
        ]);
    }

    /**
     * @param  array<string, string>  $tabs
     */
    protected function allowedTab(Request $request, array $tabs, string $default): string
    {
        $requested = (string) $request->get('tab', $default);

        if (isset($tabs[$requested]) && $request->user()->allows($tabs[$requested])) {
            return $requested;
        }

        foreach ($tabs as $tab => $permission) {
            if ($request->user()->allows($permission)) {
                return $tab;
            }
        }

        abort(403);
    }
}
