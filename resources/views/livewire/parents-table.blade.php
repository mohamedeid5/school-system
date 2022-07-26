<div>
    <button class="btn btn-primary" wire:click="showAddForm">{{ __('parents.add_parent') }}</button>
    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showformadd" type="button">{{ trans('parents.add_parent') }}</button><br><br>
    <div class="table-responsive">
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('parents.email') }}</th>
                <th>{{ trans('parents.father_name') }}</th>
                <th>{{ trans('parents.father_national_id') }}</th>
                <th>{{ trans('parents.father_passport_id') }}</th>
                <th>{{ trans('parents.father_phone') }}</th>
                <th>{{ trans('parents.father_job') }}</th>
                <th>{{ trans('parents.processes') }}</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @foreach ($parents as $parents)
                <tr>
                    <?php $i++; ?>
                    <td>{{ $i }}</td>
                    <td>{{ $parents->email }}</td>
                    <td>{{ $parents->father_name }}</td>
                    <td>{{ $parents->father_national_id }}</td>
                    <td>{{ $parents->father_passport_id }}</td>
                    <td>{{ $parents->father_phone }}</td>
                    <td>{{ $parents->father_job }}</td>
                    <td>
                        <button wire:click="edit({{ $parents->id }})" title="{{ trans('grades.edit') }}"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $parents->id }})" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
