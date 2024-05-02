<x-admin.layouts.app :title="getbreadcumb()">
    <div class="ic-role">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" id="form">
            @csrf
            @method('PUT')

            <div class="ic_form row mb_24">
                <!-- Role Name -->
                <div class="col-lg-8">
                    <label class="form-label">Role Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}"
                        placeholder="Enter role name">
                </div>
            </div>

            <div class="ic_form mb_24">
                <div class="form-check">
                    <input type="checkbox" name="parent_id" class="form-check-input" id="customCheck-all"
                        value="all">
                    <label class="form-check-label" for="customCheck-all">Check All Permissions</label>
                </div>
            </div>

            <!-- Accordion -->
            <div class="ic_form gx-xxl-4 gx-xl-3 gx-sm-2 row">
                @foreach ($permissions as $permission)
                    @if ($permission->parent_id === null)
                        <div class="col-md-4 col-sm-6 mb_24">
                            <div class="accordion" id="accordionPermission_{{ $permission->id }}">
                                <div class="accordion-item" data-id="{{ $permission->id }}">
                                    <h2 class="accordion-header" id="role_{{ $permission->id }}">
                                        <div class="ic-check-all">
                                            <input type="checkbox" name="permissions[]" class="form-check-input"
                                                id="customCheck-{{ $permission->id }}"
                                                onchange="loadChildren({{ $permission->id }})"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="customCheck-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseRole_{{ $permission->id }}" aria-expanded="true"
                                            aria-controls="collapseRole_{{ $permission->id }}">

                                        </button>
                                    </h2>
                                    <div id="collapseRole_{{ $permission->id }}"
                                        class="accordion-collapse collapse show"
                                        aria-labelledby="role_{{ $permission->id }}"
                                        data-bs-parent="#accordionPermission_{{ $permission->id }}">
                                        <div class="accordion-body">
                                            @foreach ($permissions->where('parent_id', $permission->id) as $children)
                                                <div class="form-check">
                                                    <input type="checkbox"
                                                        class="form-check-input parent-identy-{{ $permission->id }}"
                                                        name="permissions[]" id="customCheck-{{ $children->id }}"
                                                        value="{{ $children->name }}"
                                                        {{ in_array($children->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="customCheck-{{ $children->id }}">{{ $children->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <div class="right-button-group ">
                    <a href="{{ route('admin.roles.index') }}" class="ic-button white">Cancel</a>
                    <button type="submit" class="ic-button primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <x-slot name="topStyle"></x-slot>
    <x-slot name="bottomScript">
        <script>
            $(document).ready(function() {
                $("#customCheck-all").click(function() {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                    $('div .ic_div-show').show();
                });
            });

            function loadChildren(parent_id) {
                $(`#ic_parent-${parent_id}`).toggle();

                if ($(`#customCheck-${parent_id}`).is(':checked')) {
                    $(`.parent-identy-${parent_id}`).each(function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $(`.parent-identy-${parent_id}`).each(function() {
                        $(this).prop('checked', false);
                    });
                }
            }
        </script>
    </x-slot>
</x-admin.layouts.app>
