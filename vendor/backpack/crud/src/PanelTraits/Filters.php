<?php

namespace Backpack\CRUD\PanelTraits;

trait Filters
{
    public $filters = [];

    /**
     * @return bool
     */
    public function filtersEnabled()
    {
        return ! is_array($this->filters);
    }

    /**
     * @return bool
     */
    public function filtersDisabled()
    {
        return is_array($this->filters);
    }

    public function enableFilters()
    {
        if ($this->filtersDisabled()) {
            $this->filters = new FiltersCollection;
        }
    }

    public function disableFilters()
    {
        $this->filters = [];
    }

    public function clearFilters()
    {
        $this->filters = new FiltersCollection;
    }

    /**
     * Add a filter to the CRUD table view.
     *
     * @param array               $options        Name, type, label, etc.
     * @param bool|array|\Closure $values         The HTML for the filter.
     * @param bool|\Closure       $filter_logic   Query modification (filtering) logic when filter is active.
     * @param bool|\Closure       $fallback_logic Query modification (filtering) logic when filter is not active.
     */
    public function addFilter($options, $values = false, $filter_logic = false, $fallback_logic = false)
    {
        // if a closure was passed as "values"
        if (is_callable($values)) {
            // get its results
            $values = $values();
        }

        // enable the filters functionality
        $this->enableFilters();

        // check if another filter with the same name exists
        if (! isset($options['name'])) {
            abort(500, 'All your filters need names.');
        }
        if ($this->filters->contains('name', $options['name'])) {
            abort(500, "Sorry, you can't have two filters with the same name.");
        }

        // add a new filter to the interface
        $filter = new CrudFilter($options, $values, $filter_logic);
        $this->filters->push($filter);

        // if a closure was passed as "filter_logic"
        if ($this->doingListOperation()) {
            if ($this->request->has($options['name'])) {
                if (is_callable($filter_logic)) {
                    // apply it
                    $filter_logic($this->request->input($options['name']));
                } else {
                    $this->addDefaultFilterLogic($filter->name, $filter_logic);
                }
            } else {
                //if the filter is not active, but fallback logic was supplied
                if (is_callable($fallback_logic)) {
                    // apply the fallback logic
                    $fallback_logic();
                }
            }
        }
    }

    /**
     * @param string $name
     * @param string $operator
     */
    public function addDefaultFilterLogic($name, $operator)
    {
        $input = \Request::all();

        // if this filter is active (the URL has it as a GET parameter)
        switch ($operator) {
            // if no operator was passed, just use the equals operator
            case false:
                $this->addClause('where', $name, $input[$name]);
                break;

            case 'scope':
                $this->addClause($operator);
                break;

            // TODO:
            // whereBetween
            // whereNotBetween
            // whereIn
            // whereNotIn
            // whereNull
            // whereNotNull
            // whereDate
            // whereMonth
            // whereDay
            // whereYear
            // whereColumn
            // like

            // sql comparison operators
            case '=':
            case '<=>':
            case '<>':
            case '!=':
            case '>':
            case '>=':
            case '<':
            case '<=':
                $this->addClause('where', $name, $operator, $input[$name]);
                break;

            default:
                abort(500, 'Unknown filter operator.');
                break;
        }
    }

    /**
     * @return array
     */
    public function filters()
    {
        return $this->filters;
    }

    /**
     * @param string $name
     *
     * @return null|CrudFilter
     */
    public function getFilter($name)
    {
        if($this->filtersEnabled()){
            return $this->filters()->firstWhere('name', $name);
        }
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasActiveFilter($name)
    {
        $crudFilter = $this->getFilter($name);

        return $crudFilter instanceof CrudFilter && $crudFilter->isActive();
    }

    /**
     * Modify the attributes of a filter.
     *
     * @param  string $name          The filter name.
     * @param  array  $modifications An array of changes to be made.
     *
     * @return CrudFilter               The filter that has suffered modifications, for daisychaining methods.
     */
    public function modifyFilter($name, $modifications)
    {
        $filter = $this->filters->firstWhere('name', $name);

        if (! $filter) {
            abort(500, 'CRUD Filter "'.$name.'" not found. Please check the filter exists before you modify it.');
        }

        if (is_array($modifications)) {
            foreach ($modifications as $key => $value) {
                $filter->{$key} = $value;
            }
        }

        return $filter;
    }

    public function removeFilter($name)
    {
        $this->filters = $this->filters->reject(function ($filter) use ($name) {
            return $filter->name == $name;
        });
    }

    public function removeAllFilters()
    {
        $this->filters = collect([]);
    }

    /**
     * Determine if the current CRUD action is a list operation (using standard or ajax DataTables).
     * @return bool
     */
    public function doingListOperation()
    {
        $route = $this->route;

        switch ($this->request->url()) {
            case url($this->route):
                if ($this->request->getMethod() == 'POST' ||
                    $this->request->getMethod() == 'PATCH') {
                    return false;
                }

                return true;
                break;

            case url($this->route.'/search'):
                return true;
                break;

            default:
                return false;
                break;
        }
    }
}

class FiltersCollection extends \Illuminate\Support\Collection
{
    public function removeFilter($name)
    {
    }

    // public function count()
    // {
    //     dd($this);
    // }
}

class CrudFilter
{
    public $name; // the name of the filtered variable (db column name)
    public $type = 'select'; // the name of the filter view that will be loaded
    public $label;
    public $placeholder;
    public $values;
    public $options;
    public $currentValue;
    public $view;
    public $viewNamespace = 'crud::filters';

    public function __construct($options, $values, $filter_logic)
    {
        $this->checkOptionsIntegrity($options);

        $this->name = $options['name'];
        $this->type = $options['type'];
        $this->label = $options['label'];
        $this->viewNamespace = $options['view_namespace'] ?? $this->viewNamespace;
        $this->view = $this->viewNamespace.'.'.$this->type;
        $this->placeholder = $options['placeholder'] ?? '';

        $this->values = $values;
        $this->options = $options;

        if (\Request::has($this->name)) {
            $this->currentValue = \Request::input($this->name);
        }
    }

    public function checkOptionsIntegrity($options)
    {
        if (! isset($options['name'])) {
            abort(500, 'Please make sure all your filters have names.');
        }
        if (! isset($options['type'])) {
            abort(500, 'Please make sure all your filters have types.');
        }
        if (! \View::exists('crud::filters.'.$options['type'])) {
            abort(500, 'No filter view named "'.$options['type'].'.blade.php" was found.');
        }
        if (! isset($options['label'])) {
            abort(500, 'Please make sure all your filters have labels.');
        }
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        if (\Request::has($this->name)) {
            return true;
        }

        return false;
    }
}
