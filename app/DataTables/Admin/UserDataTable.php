<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use PDF;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.action')
            ->addColumn('action', function ($item) {
                $buttons = '';
                return '<div class="ic-action-wrapper">
                <div class="ic-action">
                            <a href="' . route('admin.users.show', $item->id) . '"><i class="ri-eye-line"></i></a>
                        </div> 
                        <div class="ic-action">
                            <a href="' . route('admin.users.edit', $item->id) . '"><i class="ri-pencil-line"></i></a>
                        </div>
                        <div class="ic-action">
                        <form action="' . route('admin.users.destroy', $item->id) . '"  id="delete-form-' . $item->id . '" method="post" style="">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button onclick="return makeDeleteRequest(event, ' . $item->id . ')"  type="submit">
                                <i class="ri-delete-bin-6-line"></i>
                            </button>
                        </form>
                    </div></div>';
            })->editColumn('avatar', function ($item) {
                $url = get_storage_image('user', $item->avatar);

                return '<div class="ic_image">
                <img  src="' . $url . '" alt="' . $item->name . '" /></div>';
            })->editColumn('first_name', function ($item) {
                $full_name = $item->first_name . ' ' . $item->last_name;
                return $full_name;
            })->editColumn('status', function ($item) {
                $badge = $item->status == ACTIVE ? 'active' : 'inactive ';
                return '<div class="ic-badge ' . $badge . '">' . Str::upper($item->status) . '</div>';
            })
            ->rawColumns(['action', 'first_name', 'avatar', 'status'])->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
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
            Column::make('avatar', 'avatar')->title('Image'),
            Column::make('first_name', 'first_name')->title('Full Name'),
            Column::make('email', 'email')->title('Email'),
            Column::make('status', 'status')->title('Status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
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
