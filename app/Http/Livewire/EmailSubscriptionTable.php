<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EmailSubscription;

class EmailSubscriptionTable extends LivewireTableComponent
{
    public $paginationTheme = 'bootstrap-5';
    public string $primaryKey = 'email_subscription_id';
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';
    protected $listeners = ['refresh' => '$refresh'];
    protected string $pageName = 'email-subscription-table';

    public function columns(): array
    {
        return [
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make(__('messages.common.action'))->addClass('w-100px'),
        ];
    }

    public function query(): Builder
    {
        return EmailSubscription::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.email_subscription_table';
    }
}
