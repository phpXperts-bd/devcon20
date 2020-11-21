@if ($crud->hasAccess('bulkProfileLink') && $crud->get('list.bulkActions'))
    <a href="javascript:void(0)" onclick="bulkProfileLink(this)" class="btn btn-primary"><i class="fa fa-envelope"></i> Send Profile Link</a>
@endif

@push('after_scripts')
    <script>
        if (typeof bulkProfileLink != 'function') {
            function bulkProfileLink(button) {

                var message = "Are you sure to send profile link?";
                var button = $(this);

                // show confirm message
                swal({
                    title: "{{ trans('backpack::base.warning') }}",
                    text: message,
                    icon: "warning",
                    buttons: {
                        cancel: {
                            text: "{{ trans('backpack::crud.cancel') }}",
                            value: null,
                            visible: true,
                            className: "bg-secondary",
                            closeModal: true,
                        },
                        delete: {
                            text: "Send Profile Link",
                            value: true,
                            visible: true,
                            className: "bg-success",
                        }
                    },
                }).then((value) => {
                    if (value) {
                        var ajax_calls = [];
                        var delete_route = "{{ url($crud->route) }}/bulk-profile-link";

                        // submit an AJAX delete call
                        $.ajax({
                            url: delete_route,
                            type: 'POST',
                            success: function(result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "success",
                                    text: "<strong>Successfully Sent!</strong>"
                                }).show();

                                crud.checkedItems = [];
                                crud.table.ajax.reload();
                            },
                            error: function(result) {
                                // Show an alert with the result
                                new Noty({
                                    type: "warning",
                                    text: "<strong>Something went wrong!</strong>"
                                }).show();
                            }
                        });
                    }
                });
            }
        }
    </script>
@endpush
