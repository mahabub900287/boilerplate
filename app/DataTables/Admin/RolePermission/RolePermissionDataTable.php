<?php

namespace App\DataTables\Admin\RolePermission;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use PDF;

class RolePermissionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'rolepermission.action')
            ->addColumn('action', function ($item) {
                $buttons = '';
                return '<div class="ic-action-wrapper">' .
                    (auth()->user()->can('Edit Role') ?
                        '<div class="ic-action">
                            <a href="' . route('admin.roles.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>' : '') .
                    (auth()->user()->can('Delete Role') ?
                        '<div class="ic-action">
                        <form action="' . route('admin.roles.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </form>
                    </div>' : '') .
                    '</div>';
            })
            ->editColumn('created_at', function ($item) {
                $formattedDate = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d F Y');

                return $formattedDate;
            })
            ->rawColumns(['action', 'created_at'])->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Role  $model
     */
    public function query(Role $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'DESC');
    }

    /**
     * Optional method if you want to use html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '55px', 'class' => 'text-center', 'printable' => false, 'exportable' => false, 'title' => 'Action'])
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex', 'SL#'),
            Column::make('name', 'name')->title('Name'),
            Column::make('created_at', 'created_at')->title('Created At'),
        ];
    }

    /**
     * Get filename for export.
     */
    protected function filename(): string
    {
        return 'RolePermission_' . date('YmdHis');
    }
    public function pdf()
    {
        $data = $this->getDataForExport();

        $pdf = PDF::loadView('vendor.datatables.print', [
            'data' => $data,
        ]);

        return $pdf->download($this->getFilename() . '.pdf');
    }
}
