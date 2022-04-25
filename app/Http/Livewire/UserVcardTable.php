<?php

namespace App\Http\Livewire;

use App\Repositories\VcardRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Vcard;

class UserVcardTable extends LivewireTableComponent
{

    public $paginationTheme = 'bootstrap-5';
    protected $listeners = ['refresh' => '$refresh', 'changeFilter'];
    public string $primaryKey = 'vcard_id';
    protected string $pageName = 'user-vcard-table';
    public string $defaultSortColumn = 'created_at';
    public string $defaultSortDirection = 'desc';


    public function columns(): array
    {
        return [
            Column::make(__('messages.vcard.vcard_name'), "name")
                ->sortable()->searchable(),
            Column::make(__('messages.vcard.preview_url'), "preview_url"),
            Column::make(__('messages.vcard.stats') , "stats"),
            Column::make(__('messages.vcard.status'), "first_name")
                ->sortable(),
            Column::make(__('messages.vcard.created_on'), "created_at")
                ->sortable(),
            Column::make(__('messages.common.action')),
        ];
    }

    public function query(): Builder
    {
        return Vcard::with(['tenant.user', 'template'])->where('tenant_id', getLogInTenantId())->select('vcards.*');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_vcard_table';
    }

    public function render()
    {
        $vcardRepo = App::make(VcardRepository::class);
        $makeVcard = $vcardRepo->checkTotalVcard();
        return view('livewire-tables::'.config('livewire-tables.theme').'.datatable')
            ->with([
                'columns'       => $this->columns(),
                'rowView'       => $this->rowView(),
                'filtersView'   => $this->filtersView(),
                'customFilters' => $this->filters(),
                'rows'          => $this->rows,
                'modalsView'    => $this->modalsView(),
                'bulkActions'   => $this->bulkActions,
                'componentName' => 'vcards.add-button',
                'makeVcard'     =>  $makeVcard,
            ]);
    }

}
