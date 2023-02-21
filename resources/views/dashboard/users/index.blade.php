@extends('dashboard.layouts.layout')
@section('content')
<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="deleteForm">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align:center">{{__('words.confirm_delete_head')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">{{__('words.confirm_delete_body')}}</p>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('words.ok')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('words.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="restoreModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get" id="restoreForm">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align:center">{{__('words.confirm_restore_head')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">{{__('words.confirm_restore_body')}}</p>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('words.ok')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('words.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="finalDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="get" id="finalDeleteForm">
                <div class="modal-header">
                    <h5 class="modal-title" style="text-align:center">{{__('words.confirm_final_delete_head')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style="text-align:center">{{__('words.confirm_final_delete_body')}}</p>
                    <input type="hidden" name="id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{__('words.ok')}}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('words.close')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Breadcrumb -->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a class="breadcrumb-btn" href="{{route('dashboard.index')}}">
            {{__('words.dashboard')}}
        </a>
    </li>
    <li class="breadcrumb-item active">
        <a class="breadcrumb-btn active" href="#">
            {{__('words.users')}}
        </a>
    </li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            @can('create', auth()->user())
            <div class="row">
                <div class="form-group col-sm-12">
                    <a href="{{route('users.create')}}" class="btn btn-primary">{{__('words.create_new_user')}}</a>
                </div>
            </div>
            @endcan
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
        @endif
        
            <div class="col-12">
                <div class="card" style="overflow-x: auto">
                    <div class="card-header">
                        {{__('words.users')}}
                    </div>
                    <div class="card-block">
                        <table class="table datatableActivate table-responsive" style="overflow-x: auto">
                            <thead>
                                <tr>
                                    <th class="text-center">{{__('words.id')}}</th>
                                    <th class="text-center">{{__('words.name')}}</th>
                                    <th class="text-center">{{__('words.email')}}</th>
                                    <th class="text-center">{{__('words.status')}}</th>
                                    <th class="text-center">{{__('words.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(function()
    {
        var table = $('.datatableActivate').DataTable(
        {
            processing: true,
            serverSide: true,
            order: [
                [0, 'desc']
            ],
            ajax: "{{route('users.list')}}",
            columnDefs: 
            [
                {
                    targets: 0,
                    className: 'dt-center',
                },
                {
                    targets: 1,
                    className: 'dt-center',
                },
                {
                    targets: 2,
                    className: 'dt-center',
                },
                {
                    targets: 3,
                    className: 'dt-center',
                },
                {
                    targets: 4,
                    className: 'dt-center',
                },
            ],
            columns:
            [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions'
                }
            ]
        });
    })

    $(document).on('click', '.delete-btn', function()
    {
        $('#deleteForm').attr('action', '/dashboard/users/'+$(this).data('id'));
    });
    $(document).on('click', '.restore-btn', function()
    {
        $('#restoreForm').attr('action', '/dashboard/users/restore/'+$(this).data('id'));
    });
    $(document).on('click', '.finalDelete-btn', function()
    {
        $('#finalDeleteForm').attr('action', '/dashboard/users/final-delete/'+$(this).data('id'));
    });
</script>
@endpush