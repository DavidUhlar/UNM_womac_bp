@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Úprava role</h1>
        <div class="lead">
            Úprava role a spravovanie povolení.
        </div>

        <div class="container mt-4">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Nastal problém so vstupom</strong><br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Názov</label>
                    <input value="{{ $role->name }}"
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="Názov" required>
                </div>

                <label for="permissions" class="form-label">Priradenie povolení</label>

                <table class="table table-striped">
                    <thead>
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="20%">Názov</th>
                        <th scope="col" width="1%">Guard</th>
                    </thead>

                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox"
                                name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}"
                                class='permission'
                                {{ in_array($permission->name, $rolePermissions)
                                    ? 'checked'
                                    : '' }}>
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>

                <button type="submit" class="btn btn-primary">Uložiť zmeny</button>
                <a href="{{ route('roles.index') }}" class="btn btn-default">Návrat</a>
            </form>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection
