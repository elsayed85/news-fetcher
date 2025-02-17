<?php

namespace App\Filters;

use App\Contracts\Filters\FilterInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use ReflectionClass;

abstract class BaseFilter implements FilterInterface
{
    protected Builder $query;
    protected array $appliedFilters = [];

    public function __construct(protected Request $request)
    {
    }

    public function apply(Builder $query): Builder
    {
        $this->query = $query;

        foreach ($this->getFilterMethods() as $method) {
            if (!in_array($method, $this->appliedFilters)) {
                $this->$method(); // Apply the filter
                $this->appliedFilters[] = $method; // Mark it as applied
            }
        }

        return $this->query;
    }

    /**
     * Get all the filter methods, including those from child classes.
     *
     * @return array
     */
    public function getFilterMethods(): array
    {
        $methods = [];

        $reflection = new ReflectionClass($this);
        while ($reflection) {
            $methods = array_merge($methods, array_filter($reflection->getMethods(), function ($method) {
                return str_starts_with($method->name, 'filter');
            }));

            $reflection = $reflection->getParentClass();
        }

        return array_map(fn($method) => $method->name, $methods);
    }


    protected function getUser(): User|null
    {
        return $this->request->user();
    }
}
